<main class="site-main" id="site-main" role="main">
	<div class="main-content">
		<?php
			if ( have_posts() ) {
				echo '<ul class="search-items">';
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/contents/search-item', '', array( 'display' => 'li' ) );
				}
				echo '</ul>';
			} else {
				echo '<span class="h2" role="status">' . esc_html__( 'Diese Suche ergab keine Treffer.', 'fc-theme' ) . '</span>';
			}
		?>
	</div>
</main>