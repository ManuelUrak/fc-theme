<div class="block block--small content-image">
	<div class="block__outer">
		<div class="block__inner">
			<div class="image">
				<div class="img-container img-container--cover lazy">
					<div class="img-container__inner">
						<?php
							$imgsrc = get_field( 'block_image_image' );
							printf( '<img %s title="%s" alt="%s" />', fc_theme_responsive_image( $imgsrc, 'medium_large', '768px' ), esc_attr( get_the_title( $imgsrc ) ), esc_attr( get_post_meta( $imgsrc, '_wp_attachment_image_alt', true ) ) );
						?>
					</div>
				</div>
				<?php
					if ( !empty( $imgcaption = get_field( 'block_image_caption' ) ) ) {
						printf( '<div class="image__caption content"><p class="caption">%s</p></div>', esc_html( $imgcaption ) );
					}
				?>
			</div>
		</div>
	</div>
</div>