<?php

/********************** Custom Post Types Setup **********************/

// Custom Post Types - http://codex.wordpress.org/Post_Types
// Reference for 'menu_icon' -- http://www.kevinleary.net/wordpress-dashicons-list-custom-post-type-icons/
// repeat this block as many times as needed

add_action('init', 'custom_type_register');
function custom_type_register() {
   $labels = array(
      'name' => 'Custom Post',
      'singular_name' => 'Custom Post',
      'add_new' => 'New Custom Post',
      'add_new_item' => 'Add New Custom Post',
      'edit_item' => 'Edit Custom Post',
      'new_item' => 'New Custom Post',
      'view_item' => 'View Custom Post',
      'search_items' => 'Search Custom Posts',
      'not_found' => 'Found No Custom Posts',
      'not_found_in_trash' => 'Nothing in Trash',
      'parent_item_colon' => ''
   );
   $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-admin-post',
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => 4,
      'supports' => array('title','editor','thumbnail', 'custom-fields', 'excerpt')
     ); 
   register_post_type( 'new-custom-type' , $args );
}


//use to add custom categories or tags to your custom post types
//set hierarchical to true for category behavior, false for tags
register_taxonomy( 'custom_taxonomies', 
   array('new-custom-type'), 
   array('hierarchical' => true,   
      'labels' => array(
         'name' => 'Custom Taxonomies', 
         'singular_name' => 'Taxonomy', 
         'search_items' =>  'Search Taxonomies', 
         'all_items' => 'All Taxonomies',
         'parent_item' => 'Parent Taxonomy',
         'parent_item_colon' => 'Parent Taxonomy;', 
         'edit_item' => 'Edit Taxonomy', 
         'update_item' => 'Update Taxonomy',
         'add_new_item' => 'Add New Taxonomy',
         'new_item_name' => 'New Taxonomy'
      ),
      'show_admin_column' => true,
      'show_ui' => true,
      'query_var' => true,
   )
);


/********************* Modify Admin Post Columns ************************/

// Adds custom field previews for posts/post-types in admin section

add_filter('manage_edit-new-custom-type_columns', 'custom_type_table_head');
function custom_type_table_head( $columns ) {
  $columns['field_key']  = 'Example';
 
  return $columns;
}

add_action( 'manage_posts_custom_column', 'custom_type_table_content', 10, 2 );
function custom_type_table_content( $column_name ) {
   global $post;
   if( $column_name == 'field_key' ) {
      $value = get_post_meta( $post->ID, 'field_key', true );
      echo $value;
   }
}



/********************** Login and Admin Frontend *********************/

add_action('admin_head','mag_admin_css');
add_action('login_enqueue_scripts', 'mag_admin_css');
function mag_admin_css() { 
   echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/assets/css/admin.css"/>';
}

//if necessary you can add js the same way
// add_action('admin_footer','mag_admin_js'); 
function mag_admin_js() { ?>
<?php } 


// admin footer message, shown in bottom left on all screens
function mag_admin_footer() {
   echo '<span id="footer-thankyou">Wordpress Theme by <a href="http://www.magneticcreative.com">Magnetic Creative</a>.</span>';
}
add_filter('admin_footer_text', 'mag_admin_footer');


// don't link to wordpress.org from login
add_filter('login_headerurl', 'mag_login_url');
function mag_login_url() { 
   return get_bloginfo('url'); 
}

// changes alt text on logo
add_filter('login_headertitle', 'mag_login_title');
function mag_login_title() { 
   return get_option('blogname'); 
}




/************************ Wordpress Cleanup ****************************/

// remove unneccessary stuff from doc head

remove_action( 'wp_head', 'feed_links', 2);
remove_action( 'wp_head', 'feed_links_extra', 3);
remove_action( 'wp_head', 'rsd_link' );       
remove_action( 'wp_head', 'wlwmanifest_link' );                                
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); 
remove_action( 'wp_head', 'wp_generator' );


// removes p tags around images added through visual editor
add_filter('the_content', 'mag_filter_ptags_on_images');
function mag_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// replaces self closing tags
add_filter('get_avatar', 'mag_remove_self_closers');
add_filter('comment_id_fields', 'mag_remove_self_closers');
add_filter('post_thumbnail_html', 'mag_remove_self_closers');
function mag_remove_self_closers($input) {
  return str_replace(' />', '>', $input);
}

// Removes p tags added around content and excerpt
//remove_filter('the_content', 'wpautop'); //probably don't want to uncomment
remove_filter('the_excerpt', 'wpautop');

// Disable default dash widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
   // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); 
   // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);   
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); 
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);            
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);    
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);        
   unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);          
}
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );


/************************ Trackback Disable **************************/
// disable the pingback method, remove the headers and rewrite rules

function mag_filter_xmlrpc_method($methods) {
  unset($methods['pingback.ping']);
  return $methods;
}
add_filter('xmlrpc_methods', 'mag_filter_xmlrpc_method', 10, 1);

function mag_filter_pingback_headers($headers) {
  if (isset($headers['X-Pingback'])) { unset($headers['X-Pingback']); }
  return $headers;
}
add_filter('wp_headers', 'mag_filter_pingback_headers', 10, 1);

function mag_filter_pingback_rewrites($rules) {
  foreach ($rules as $rule => $rewrite) {
    if (preg_match('/trackback\/\?\$$/i', $rule)) { unset($rules[$rule]); }
  }
  return $rules;
}
add_filter('rewrite_rules_array', 'mag_filter_pingback_rewrites');

function mag_kill_pingback_url($output, $show) {
  if ($show === 'pingback_url') { $output = ''; }
  return $output;
}
add_filter('bloginfo_url', 'mag_kill_pingback_url', 10, 2);

function mag_kill_xmlrpc($action) {
  if ($action === 'pingback.ping') {
    wp_die('Pingbacks are not supported', 'Not Allowed!', array('response' => 403));
  }
}
add_action('xmlrpc_call', 'mag_kill_xmlrpc');



/************************* Add Blog Feed to Admin ****************************/

// add custom widget - blog feed in dash
// once our blog is running we'll have this active by default
/*function mag_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');             
		$feed = fetch_feed('http://www.magneticcreative.com/feed/');
		$limit = $feed->get_item_quantity(5);        
		$items = $feed->get_items(0, $limit);
	}
	if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   
	else foreach ($items as $item) : ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date('j F Y @ g:i a'); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php endforeach;
}*/

//adding all custom dash widgets
/*function mag_custom_dashboard_widgets() {
	wp_add_dashboard_widget('og_rss_dashboard_widget', 'The Latest From Magnetic Creative', 'mag_rss_dashboard_widget');
}*/
/*add_action('wp_dashboard_setup', 'mag_custom_dashboard_widgets');*/