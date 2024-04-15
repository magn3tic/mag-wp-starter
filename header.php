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

<link rel="shortcut icon" href="<?php echo "$root/assets/img/favicon.png"; ?>">
<link rel="apple-touch-icon" href="<?php echo "$root/assets/img/apple-touch-icon.png"; ?>">

<link rel="stylesheet" media="screen,projection" href="<?php echo "$root/assets/css/screen.css"; ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="" class="site-header">
	<div class="inner">
		<div class="site-header_left">
			<a id="site-title" href="<?php echo get_site_url(); ?>">
				<span><?php echo bloginfo('site_title'); ?></span>
			</a>
			<button id="main-nav-toggle" class="mobile-toggle">Menu</button>
		</div>
		<div class="site-header_right">
			<nav id="main-nav" class="primary-nav" role="navigation">
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