<?php 


/************* Example Shortcodes **********************/
// references:
// http://codex.wordpress.org/Shortcode_API
// http://www.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/
// if you need a way to let the client add dynamic content within the visual editor, here it is



/************* Simple Example **************/
//simple shortcodes have no attributes/arguments
function do_mag_shortcode() {
	global $post;

		//- retrieve values using attached to current post

	//build html after starting output buffer
	ob_start(); ?>
	
	<?php
	return ob_get_clean();
}

/************* Example w/ Parameters ******************/
//allows listing of recent posts 
function mag_recent_posts_shortcode($atts) {
	global $post;
	$post_to_exclude = $post->ID;
	
	extract( shortcode_atts(array(
		'count' => 3
	), $atts));

	ob_start();
		echo '<div class="sc-recentposts">';
		$wpq = new WP_query(array(
			'posts_per_page' => $count,
			'paged' => false
			));
		if ($wpq->have_posts()) : while ($wpq->have_posts()) : $wpq->the_post(); ?>
			<div class="sc-recentposts_post">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<small><?php the_date(); ?></small>
			</div>
		<?php
		endwhile; endif; wp_reset_postdata();
		echo '</div>';
	return ob_get_clean();
}


/************* Example w/ Params/Content ******************/
//adds styles buttons
function mag_button_shortcode($atts,$content = null) {
	extract( shortcode_atts(array(
		'url' => '#0',
		'style' => 'medium'
		), $atts));

	ob_start();

	echo '<a href="'.$url.'" class="button button-'.$style.'">'.$content.'</a>';

	return ob_get_clean();
}



// register all shortcode functions here
// arg1 - the name of the shortcode - usage ex: [shortcode_name]
// arg2 - the function that does the stuff
function mag_register_shortcodes() {
   add_shortcode('shortcode_name', 'do_mag_shortcode');
   add_shortcode('recent-posts', 'mag_recent_posts_shortcode');
   add_shortcode('button', 'mag_button_shortcode');
}

//hook all shortcodes to wp init
add_action( 'init', 'mag_register_shortcodes');