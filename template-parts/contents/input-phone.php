<div class="input-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'tel-' . get_row_index() ); ?>">
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
	<?php printf( '<input class="input" type="tel" name="%s" placeholder="%s" id="%s" %s>', esc_attr( 'tel_' . get_row_index() ), esc_attr( get_sub_field( 'placeholder' ) ), esc_attr( 'tel-' . get_row_index() ), ( get_sub_field( 'required' ) ? 'required' : '' ) ); ?>
</div>