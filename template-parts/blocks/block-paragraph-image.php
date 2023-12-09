<div class="block block--regular content-paragraph-image">
	<div class="block__outer">
		<div class="block__inner">
			<div <?php html_class( 'paragraph-image', array( get_field( 'block_paragraph_image_alignment' ) ) ); ?>>
				<div class="paragraph-image__text content">
					<?php echo wp_kses_post( get_field( 'block_paragraph_image_text' ) ); ?>
				</div>
				<div class="paragraph-image__image">
					<div class="img-container img-container--cover lazy">
						<div class="img-container__inner">
							<?php
								$imgsrc = get_field( 'block_paragraph_image_image' );
								printf( '<img %s title="%s" alt="%s" />', fc_theme_responsive_image( $imgsrc, 'medium_large', '768px' ), esc_attr( get_the_title( $imgsrc ) ), esc_attr( get_post_meta( $imgsrc, '_wp_attachment_image_alt', true ) ) );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>