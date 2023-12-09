<main class="site-main" id="site-main" role="main">
	<div class="main-content">
		<?php
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		?>
	</div>
</main>