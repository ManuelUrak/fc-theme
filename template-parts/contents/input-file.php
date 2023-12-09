<div class="file-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'file-' . get_row_index() ); ?>">
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
	<div class="upload-area">
		<?php
			$field_settings = array(
				'size' => ( get_sub_field( 'max_filesize' ) ?: '48' ),
				'length' => get_sub_field( 'max_files' )
			);
			printf( '<input type="file" name="files[]" accept="%s" id="%s" data-file-size="%s" data-file-length="%s" data-file-alert="%s" multiple %s>', esc_attr( implode( ',',  get_sub_field( 'allowed_types' ) ) ), esc_attr( 'file-' . get_row_index() ), esc_attr( ( $field_settings[ 'size' ] * 1024 * 1024 ) ), esc_attr( $field_settings[ 'length' ] ), esc_attr( sprintf( btb__( 'Bitte beachten Sie, dass Sie max. %s Datei/n mit einer Gesamtgröße von %s MB hochladen dürfen!' ), $field_settings[ 'length' ], $field_settings[ 'size' ] ) ), ( get_sub_field( 'required' ) ? 'required' : '' ) );
			printf( '<span class="filename empty" data-placeholder="%1$s">%1$s</span>', esc_html( btb__( 'Datei auswählen und hochladen' ) ) );
		?>
	</div>
</div>