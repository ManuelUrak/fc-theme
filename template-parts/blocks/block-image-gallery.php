<div class="block block--regular content-image-gallery">
	<div class="block__outer">
		<div class="block__inner">
			<ul class="gallery">
				<?php
					if ( !empty( $gallery_images = get_field( 'block_image_gallery_images' ) ) ) {
						global $gallery_id;
						$gallery_id = ( $gallery_id ?: 0 );
						foreach ( $gallery_images as $gallery_image ) {
							get_template_part( 'template-parts/contents/gallery-item', '', array( 'gallery_image' => $gallery_image, 'gallery_id' => $gallery_id, 'display' => 'li' ) );
						}
						$gallery_id++;
					}
				?>
			</ul>
		</div>
	</div>
</div>