<div class="block block--small content-quote">
	<div class="block__outer">
		<div class="block__inner">
			<div class="quote content">
				<q><?php echo esc_html( get_field( 'block_quote_text' ) ); ?></q>
				<?php
					if ( !empty( $quote_author_source = get_field( 'block_quote_author_source' ) ) ) {
						echo '<p class="small">' . esc_html( $quote_author_source ) . '</p>';
					}
				?>
			</div>
		</div>
	</div>
</div>