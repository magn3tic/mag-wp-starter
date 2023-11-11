<?php

// Theme activation hook
// runs after each time the theme is activated
add_action('after_switch_theme', 'mag_theme_init');
function mag_theme_init () {
}

// post-type registrations & other admin mods
include_once('lib/admin.php');

// shortcode definitions & examples
include_once('lib/shortcodes.php');

// customizer fields & examples
include_once('lib/customizer.php');

// meta field definitions
include_once('lib/metafields.php');


// Post Formats (uncomment to allow)
// options are 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
// add_theme_support('post-formats', array('link', 'quote', 'gallery'));

// html5 markup for comments and search
add_theme_support( 'html5', array( 'caption', 'comment-list', 'comment-form', 'search-form' ));

// enable featured images
add_theme_support('post-thumbnails'); 

// let plugins (like Yoast SEO) manage page title
add_theme_support('title-tag');

// Add image sizes like so, they'll get cropped on upload
// after adding new image sizes, you may to regenerate thumbnails
// use a plugin - https://wordpress.org/plugins/regenerate-thumbnails/
add_image_size( 'custom_thumb', 300, 300, true );
add_image_size( 'custom_thumb_alt', 900, 550, true );

// This is a global variable used inside wordpress to set a maximum image or object size
// Set it to about the site's container size
if (!isset($content_width)) {
  $content_width = 1600;
}

// Example search form partial
add_filter('get_search_form', 'mag_get_search_form');
function mag_get_search_form() {
	$form = '';
	locate_template('/partials/searchform.php', true, false);
	return $form;
}

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

// Customize Post Excerpts
// adjust 'more' link at end of post excerpt wp default is [...]
add_filter( 'excerpt_more', 'mag_excerpt_more_link' );
function mag_excerpt_more_link($more) {
 return ' <a href="'.get_the_permalink().'">...Read More</a>';
}

//If you need to change how wordpress handles the excerpt entirely
/*
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { 
	global $post;
	$excerpt_length = 30;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
			$text = strip_tags($text);
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}*/

// use to get plain text excerpts manually
function truncator($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}

// Widgets - if you need to set up some widgets, you can do it here
// function mag_widgets_register() {
// 	register_sidebar( array(
// 		'name' => 'example_widget',
// 		'id' => '',
// 		'before_widget' => '',
// 		'after_widget' => '',
// 		'before_title' => '',
// 		'after_title' => ''
// 	));
// }
//add_action('widgets_init', 'mag_widgets_register');

// pagination function - use it after your loops to output paginated links
if (!function_exists('mag_pagination')) :
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
