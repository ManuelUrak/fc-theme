<footer class="site-footer" id="site-footer" role="contentinfo">
	<nav class="site-nav site-nav--footer" id="site-nav-footer" role="navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'container_class' => 'site-nav__inner',
				'fallback_cb' => false
			) );
		?>
	</nav>
</footer>