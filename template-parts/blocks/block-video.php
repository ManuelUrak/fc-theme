<div class="block block--small content-video">
	<div class="block__outer">
		<div class="block__inner">
			<div class="video">
				<div class="vid-container lazy">
					<div class="vid-container__inner">
						<?php
							$video_source = get_field( 'block_video_source' );
							if ( $video_source === 'media_library' ) {
								printf( '<video data-src="%s|video/mp4" data-poster="%s" controls></video>', esc_url( wp_get_attachment_url( get_field( 'block_video_file' ) ) ), esc_url( wp_get_attachment_image_url( get_field( 'block_video_thumbnail' ), 'medium_large' ) ) );
							} else if ( $video_source === 'youtube' ) {
								$video_url = parse_url( get_field( 'block_video_url' ) );
								parse_str( $video_url[ 'query' ], $video_url_params );
								if ( $video_url_params[ 'v' ] ) {
									printf( '<iframe data-src="%s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>', esc_url( 'https://www.youtube.com/embed/' . $video_url_params[ 'v' ] ) );
								}
							}
						?>
					</div>
				</div>
				<div class="video__overlay">
					<?php if ( !empty( $imgsrc = get_field( 'block_video_thumbnail' ) ) ) : ?>
					<div class="img-container img-container--cover lazy">
						<div class="img-container__inner">
							<img <?php echo fc_theme_responsive_image( $imgsrc, 'medium_large', '768px' ); ?> />
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>