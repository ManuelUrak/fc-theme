<?php printf( '<fieldset %s data-input-width="%s">', html_class( 'checkbox-wrapper', array( get_sub_field( 'layout' ) ), false ), esc_attr( get_sub_field( 'width' ) ) ); ?>
	<legend>
		<span class="title">
			<?php
				echo esc_html( get_sub_field( 'label' ) );
				if ( get_sub_field( 'required' ) ) {
					echo '<span aria-hidden="true">*</span>';
				}
			?>
		</span>
		<?php
			if ( get_sub_field( 'description' ) ) {
				echo '<span class="description">' . esc_html( get_sub_field( 'description' ) ) . '</span>';
			}
		?>
	</legend>
	<?php
		$field_settings = array(
			'row_index' => get_row_index(),
			'required' => get_sub_field( 'required' )
		);
		if ( have_rows( 'options' ) ) {
			echo '<ul>';
			$i = 1; while ( have_rows( 'options' ) ) {
				the_row();
				echo '<li>';
				printf( '<label class="checkbox-label" for="%s">', esc_attr( 'checkbox-' . $field_settings[ 'row_index' ] . '-' . $i ) );
				printf( '<input class="checkbox" type="checkbox" name="%s" value="%s" id="%s">', esc_attr( 'checkbox_' . $field_settings[ 'row_index' ] ), esc_attr( get_sub_field( 'text' ) ), esc_attr( 'checkbox-' . $field_settings[ 'row_index' ] . '-' . $i ) );
				echo '<span></span>';
				echo wp_kses_post( get_sub_field( 'text' ) );
				echo '</label>';
				echo '</li>';
				$i++;
			}
			echo '</ul>';
			if ( $field_settings[ 'required' ] ) {
				printf( '<input class="checkbox-validation" type="hidden" name="%s" value="" id="%s" required>', esc_attr( 'checkbox_validation_' . $field_settings[ 'row_index' ] ), esc_attr( 'checkbox-validation-' . $field_settings[ 'row_index' ] ) );
			}
		}
	?>
</fieldset>