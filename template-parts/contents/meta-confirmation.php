<?php
	$confirmation_data = $args[ 'confirmation_data' ];
	$post = get_post( $confirmation_data[ 'form_data' ][ 'action_post_id' ] );
	if ( !empty( $blocks = parse_blocks( $post->post_content ) ) ) {
		foreach ( $blocks as $block ) {
			if ( $block[ 'blockName' ] === 'acf/form' ) {
				$field_objects = get_field( 'form_builder_inputs', $block[ 'attrs' ][ 'data' ][ 'block_form_form' ] );
			}
		}
	}
	if ( !empty( $confirmation_data[ 'form_data' ][ 'email' ] ) ) {
		$confirmation_link = add_query_arg( array( 'post' => 'confirm', 'post_id' => $confirmation_data[ 'post_id' ], 'confirmation_id' => $confirmation_data[ 'confirmation_id' ] ), $confirmation_data[ 'form_data' ][ 'action_link' ] );
		$field_key = array_search( 'email', array_column( $field_objects, 'acf_fc_layout' ), true );
		if ( !empty( $confirmation_mail = $field_objects[ $field_key ][ 'confirmation_mail' ] ) ) {
			echo wp_kses_post( str_replace( '[confirmation_link]', sprintf( '<a href="%1$s" target="_blank" rel="noopener">%1$s</a>', esc_url_raw( $confirmation_link ) ), apply_filters( 'acf_the_content', $confirmation_mail ) ) );
		} else {
			printf( '<p><a href="%1$s" target="_blank" rel="noopener">%1$s</a></p>', esc_url_raw( $confirmation_link ) );
		}
	}