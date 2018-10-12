<?php


//site root
$root = get_template_directory_uri();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="utf-8">

<title><?php wp_title(''); ?></title>				

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<script src="<?php echo "$root/assets/js/modernizr.js"; ?>"></script>

<link rel="shortcut icon" href="<?php echo "$root/assets/img/favicon.png"; ?>">
<link rel="apple-touch-icon" href="<?php echo "$root/assets/img/apple-touch-icon.png"; ?>">

<link rel="stylesheet" media="screen,projection" href="<?php echo "$root/assets/css/screen.css"; ?>">
<link rel="stylesheet" media="print" href="<?php echo "$root/assets/css/print.css"; ?>">

<!--[if lt IE 9]>
<link rel="stylesheet" media="print" href="<?php echo "$root/assets/css/ie.css"; ?>">
<script type="text/javascript" src="<?php echo "$root/assets/js/polyfill/respond.js"; ?>"></script>
<script type="text/javascript" src="<?php echo "$root/assets/js/polyfill/selectivizr-min.js"; ?>"></script>
<![endif]-->

<?php wp_head(); ?>

<script>
!window.jQuery && document.write('<script src="<?php echo "$root/assets/js/jquery-1.11.1.min.js"; ?>"><\/script>');
</script>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<header id="header" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
	<div class="inner">
		<div class="site-header_left">
			<a id="site-title" href="<?php echo get_site_url(); ?>">
				<i class="magicon-bolt-alt" aria-hidden="true"></i>
				<span><?php echo bloginfo('site_title'); ?></span>
			</a>
			<button id="main-nav-toggle" class="mobile-toggle">Menu</button>
		</div>
		<div class="site-header_right">
			<nav id="main-nav" class="primary-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu( array(
		    'theme_location' => 'header-menu',
		    'menu_class' => 'primary-nav_menu',
		    'container' => false
		    )); ?>
			</nav>
		</div>
	</div>
</header>

<main id="main" role="mainContentofPage">