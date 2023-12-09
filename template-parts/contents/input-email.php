<div class="input-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'email-' . get_row_index() ); ?>">
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
	<?php printf( '<input class="input" type="email" name="email" placeholder="%s" id="%s" %s>', esc_attr( get_sub_field( 'placeholder' ) ), esc_attr( 'email-' . get_row_index() ), ( get_sub_field( 'required' ) ? 'required' : '' ) ); ?>
</div>