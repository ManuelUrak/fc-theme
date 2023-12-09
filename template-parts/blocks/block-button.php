<div class="block block--small content-button">
	<div class="block__outer">
		<div class="block__inner">
			<?php
				$button_link = get_field( 'block_button_link' );
				printf( '<a %s href="%s" target="%s" rel="noopener"><span>%s</span></a>', html_class( 'button', array( get_field( 'block_button_style' ) ), false ), esc_url( $button_link[ 'url' ] ), esc_attr( $button_link[ 'target' ] ), esc_html( $button_link[ 'title' ] ?: btb__( 'Mehr dazu' ) ) );
			?>
		</div>
	</div>
</div>