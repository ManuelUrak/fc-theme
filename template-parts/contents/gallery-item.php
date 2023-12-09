<<?php html_element( $args[ 'display' ] ); ?> class="gallery-item" id="<?php echo esc_attr( 'post-' . $args[ 'gallery_image' ] ); ?>">
	<?php printf( '<a class="swipebox" href="%s" title="%s" rel="gallery-%s">', esc_url( wp_get_attachment_image_url( $args[ 'gallery_image' ], 'full' ) ), esc_attr( get_the_title( $args[ 'gallery_image' ] ) ), esc_attr( $args[ 'gallery_id' ] ) ); ?>
		<div class="img-container img-container--cover lazy">
			<div class="img-container__inner">
				<?php printf( '<img %s title="%s" alt="%s" />', fc_theme_responsive_image( $args[ 'gallery_image' ], 'medium', '480px' ), esc_attr( get_the_title( $args[ 'gallery_image' ] ) ), esc_attr( get_post_meta( $args[ 'gallery_image' ], '_wp_attachment_image_alt', true ) ) ); ?>
			</div>
		</div>
	</a>
</<?php html_element( $args[ 'display' ] ); ?>>