<?php

/************* Advanced Custom Fields ****************/

//http://www.advancedcustomfields.com/resources/ - V5-PRO
//modify plugin paths, since we include ACF in theme

add_filter('acf/settings/path', 'mag_acf_settings_path');
function mag_acf_settings_path($path) {
	$path = get_stylesheet_directory().'/lib/acf/';
	return $path;
}
add_filter('acf/settings/dir', 'mag_acf_settings_dir');
function mag_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri().'/lib/acf/';
    return $dir; 
}

//Hides the custom fields menu item
//uncomment this before handing off to client
//add_filter('acf/settings/show_admin', '__return_false');

//include/start ACF
include_once(get_stylesheet_directory().'/lib/acf/acf.php');

//Add options page and subpages
//these are ideal for global site data, style options, instructions, etc
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
	acf_set_options_page_title('Options Page');
	acf_add_options_sub_page('Sub Page One');
	acf_add_options_sub_page('Sub Page Two');
}

// changes permissions for options page, allows lower-level user access to options pages
if( function_exists('acf_set_options_page_capability') ) {
    acf_set_options_page_capability( 'manage_options' );
}


/******************** Admin Mods ***********************/

// various mods to admin and login screen
include_once('lib/admin.php');


/******************** Shortcodes ***********************/

// these are created for use in the visual editor
// see file for examples and reference links
include_once('lib/shortcodes.php');


/******************** jQuery enqueue *************************/

// this is the only js file enqueued using wordpress' api, 
// all other javascript will be embedded in footer.php or header.php
// we know this goes against commercial theme-developer best practices, 
// but it ensures our scripts/styles CAN'T be deregistered 

if (!is_admin()) add_action("wp_enqueue_scripts", "mag_script_enqueue", 11);
function mag_script_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null, null);
   wp_enqueue_script('jquery');
}


/******************** Theme Support Settings **************************/

// Post Formats
// options are 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
//add_theme_support('post-formats', array('link', 'quote', 'gallery'));

// html5 markup for comments and search
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ));

// enable featured images
add_theme_support( 'post-thumbnails' ); 

// Add image sizes like so, they'll get cropped on upload
// after adding new image sizes, you may to regenerate thumbnails
// use a plugin - https://wordpress.org/plugins/regenerate-thumbnails/
add_image_size( 'custom_thumb', 300, 300, true );
add_image_size( 'custom_thumb_alt', 900, 550, true );

// rss
add_theme_support('automatic-feed-links');



/******************** Menu Settings ***************************/

// Register Menus - see header.php for example of outputting menu
register_nav_menus( array(
	'header-menu' => 'Menu in the Heder.',
	'footer-menu' => 'Menu in the Footer.'
));

// Cleans up and/or changes wordpress' auto-generated menu classes
function mag_replace_menu_classes($text) {
	$replace = array(
    'current-menu-item' => 'active-nav-item',
    'sub-menu' => 'sub-menu',
    'menu-item-has-children' => '',
    'menu-item-type-post_type' => '',
    'menu-item-object-page' => ''
	);
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;
} 
add_filter('wp_nav_menu', 'mag_replace_menu_classes');



/********************* Pagination ****************************/

// pagination function - use it after your loops to output paginated links
if ( ! function_exists( 'mag_pagination' ) ) :
	function mag_pagination() {
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	}
endif;