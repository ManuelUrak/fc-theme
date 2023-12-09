<<?php html_element( ( $args[ 'display' ] ?: 'article' ) ); ?> class="post-item" id="<?php echo esc_attr( 'post-' . ( $args[ 'post_id' ] ?: $post->ID ) ); ?>">
	<a class="no-style" href="<?php echo esc_url( get_permalink( $args[ 'post_id' ] ?: $post ) ); ?>" rel="noopener">
		<div class="post-item__image">
			<div class="img-container img-container--cover lazy">
				<div class="img-container__inner">
					<?php
						$imgsrc = get_post_thumbnail_id( $args[ 'post_id' ] ?: $post );
						printf( '<img %s title="%s" alt="%s" />', fc_theme_responsive_image( $imgsrc, 'medium', '480px' ), esc_attr( get_the_title( $imgsrc ) ), esc_attr( get_post_meta( $imgsrc, '_wp_attachment_image_alt', true ) ) );
					?>
				</div>
			</div>
		</div>
		<div class="post-item__text content"> 
			<p class="h3"><?php echo esc_html( get_the_title( $args[ 'post_id' ] ?: $post ) ); ?></p>
			<?php
				if ( has_excerpt( $args[ 'post_id' ] ?: $post ) ) {
					echo '<p>' . esc_html( get_the_excerpt( $args[ 'post_id' ] ?: $post ) ) . '</p>';
				}
			?>
			<div class="button button--primary">
				<span><?php echo esc_html( btb__( 'Mehr dazu' ) ); ?></span>
			</div>
		</div>
	</a>
</<?php html_element( ( $args[ 'display' ] ?: 'article' ) ); ?>>