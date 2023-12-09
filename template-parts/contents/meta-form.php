<?php
	$form_data = $args[ 'form_data' ];
	$post = get_post( $form_data[ 'action_post_id' ] );
	if ( !empty( $blocks = parse_blocks( $post->post_content ) ) ) {
		foreach ( $blocks as $block ) {
			if ( $block[ 'blockName' ] == 'acf/form' ) {
				$field_objects = get_field( 'form_builder_inputs', $block[ 'attrs' ][ 'data' ][ 'block_form_form' ] );
			}
		}
	}
	$form_data_clean = array_diff_key( $form_data, array_flip( array(
		'g-recaptcha-response',
		'action',
		'action_link',
		'action_post_id',
		'files',
		'checkbox_privacy'
	) ) );
	echo '<table><tbody>';
	foreach ( $form_data_clean as $key => &$value ) {
		$field_key = (int) substr( $key, strpos( $key, '_' ) + 1 ) - 1;
		$field_object = $field_objects[ $field_key ];
		if ( is_array( $value ) ) {
			$value = implode( ', ', $value );
		}
		printf( '<tr><td style="padding-right:20px;"><strong>%s</strong></td><td>%s</td></tr>', ( $key === 'email' ) ? esc_html( btb__( 'E-Mail Adresse' ) ) : esc_html( $field_object[ 'label' ] ), wp_kses_post( $value ) );
		if ( $field_object[ 'type' ] == 'checkbox' && $field_object[ 'required' ] ) {
			unset( $form_data_clean[ 'checkbox_validation_' . ( $field_key + 1 ) ] );
		}
	}
	echo '</tbody></table>';