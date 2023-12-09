<header class="site-header" id="site-header" role="banner">
	<nav class="site-nav" id="site-nav" role="navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'main-menu',
				'container_class' => 'site-nav__inner',
				'fallback_cb' => false
			) );
		?>
	</nav>
</header>