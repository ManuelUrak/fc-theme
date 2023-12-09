<div class="input-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'text-' . get_row_index() ); ?>">
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
	</label>
	<?php printf( '<input class="input" type="text" name="%s" placeholder="%s" %s %s id="%s" %s>', esc_attr( 'text_' . get_row_index() ), esc_attr( get_sub_field( 'placeholder' ) ), ( get_sub_field( 'min_chars' ) ? esc_attr( 'minlength="' . get_sub_field( 'min_chars' ) . '"' ) : '' ), ( get_sub_field( 'max_chars' ) ? esc_attr( 'maxlength="' . get_sub_field( 'max_chars' ) . '"' ) : '' ), esc_attr( 'text-' . get_row_index() ), ( get_sub_field( 'required' ) ? 'required' : '' ) ); ?>
</div>