<?php

// Footer

$root = get_template_directory_uri();
?>
</main><?php //close main, opens in header ?>

<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="inner">
		<nav class="site-footer_nav">
		<?php /*wp_nav_menu( array(
	    'theme_location' => 'footer-menu',
	    'menu_class' => 'site-footer_nav-menu',
	    'container' => false
	    )); */ ?>
	  </nav>
	  <p class="site-footer_copyright">&copy; <?php echo date('Y'); ?> <?php echo bloginfo('site_name'); ?></p>
	</div>
</footer>

<script src="<?php echo "$root/assets/js/app.bundle.js"; ?>"></script>
<?php wp_footer(); ?>
</body>