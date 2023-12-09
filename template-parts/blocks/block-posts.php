<div class="block block--regular content-posts">
	<div class="block__outer">
		<div class="block__inner">
			<ul class="posts">
				<?php
					if ( !empty( $posts = get_field( 'block_posts_posts' ) ) ) {
						foreach ( $posts as $post ) {
							get_template_part( 'template-parts/contents/post-item', '', array( 'post_id' => $post, 'display' => 'li' ) );
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>