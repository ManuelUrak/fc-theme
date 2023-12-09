<main class="site-main" id="site-main" role="main">
	<div class="main-content">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/contents/post-item', get_query_var( 'post_type' ) );
				}
			}
		?>
	</div>
</main>