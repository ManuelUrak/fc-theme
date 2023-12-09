<div class="select-wrapper" data-input-width="<?php echo esc_attr( get_sub_field( 'width' ) ); ?>">
	<label for="<?php echo esc_attr( 'select-' . get_row_index() ); ?>">
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
	<?php
		$field_settings = array(
			'row_index' => get_row_index(),
			'required' => get_sub_field( 'required' ),
			'placeholder' => get_sub_field( 'placeholder' ),
			'search' => get_sub_field( 'show_search' )
		);
		if ( have_rows( 'options' ) ) {
			echo '<div class="fselect">';
			printf( '<select name="%s" id="%s" data-fselect-search="%s" data-fselect-search-text "%s" data-fselect-results-text="%s" %s>', esc_attr( 'select_' . $field_settings[ 'row_index' ] ), esc_attr( 'select-' . $field_settings[ 'row_index' ] ), ( $field_settings[ 'search' ] ? 'true' : 'false' ), esc_attr( btb__( 'Suche' ) ), esc_attr( btb__( 'Keine Ergebnisse' ) ), ( $field_settings[ 'required' ] ? 'required' : '' ) );
			echo '<option value="" selected>' . esc_html( ( $field_settings[ 'placeholder' ] ?: btb__( 'Option auswählen' ) ) ) . '</option>';
			while ( have_rows( 'options' ) ) {
				the_row();
				printf( '<option value="%s">%s</option>', esc_attr( get_sub_field( 'text' ) ), esc_html( get_sub_field( 'text' ) ) );
			}
			echo '</select>';
			echo '</div>';
		}
	?>
</div>