<div class="date-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'date-' . get_row_index() ); ?>">
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
	<div class="flatpickr">
		<?php
			$field_settings = array(
				'min_date' => get_sub_field( 'min_date' ),
				'max_date' => get_sub_field( 'max_date' )
			);
			printf( '<input class="date" type="date" name="%s" placeholder="%s" data-flatpickr-input="true" data-flatpickr-min-date="%s" data-flatpickr-max-date="%s" id="%s" %s>', esc_attr( 'date_' . get_row_index() ), esc_attr( btb__( 'TT.MM.JJJJ' ) ), esc_attr( $field_settings[ 'min_date' ][ 'date' ] ?: ( $field_settings[ 'min_date' ][ 'today' ] ? current_time( 'Y-m-d' ) : '' ) ), esc_attr( $field_settings[ 'max_date' ][ 'date' ] ?: ( $field_settings[ 'max_date' ][ 'today' ] ? current_time( 'Y-m-d' ) : '' ) ), esc_attr( 'date-' . get_row_index() ), ( get_sub_field( 'required' ) ? 'required' : '' ) );
		?>
	</div>
</div>