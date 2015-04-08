<?php

// Setup a child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array('parent-style')
	);
}

// Create a custom post type
add_action('init', 'create_post_type');

function create_post_type() {
	$args = array(
		'labels' => post_type_labels( 'Issue' ),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-book-alt',
		'supports' => array('title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'comments',
			'post-formats'
		)
	);

	register_post_type( 'issue', $args);
}

// A helper fucntion for generating the labels...
function post_type_labels($singular, $plural = '')
{
	if($plural == '') $plural = $singular . 's';
		return array(
			'name' => _x($plural, 'post type general name'),
			'singular_name' => _x($singular, 'post type singular name'),
			'add_new' => __('Add New'),
			'add_new_item' => __('Add New ' . $singular),
			'edit_item' => __('Edit ' . $singular),
			'new_item' => __('New ' . $singular),
			'view_item' => __('View' . $singular),
			'search_items' => __('Search ' . $plural),
			'not_found' => __('No ' . $plural . ' found'),
			'not_found_in_trash' => __('No ' . $plural . ' found in Trash'),
			'parent_item_colon' => ''
		);
}

// Add filter to ensure the text Issue, or issue, is displayed when user updates a issue
add_filter('post_updated_messages', 'post_type_updated_messages');

function post_type_updated_messages($messages) {
	global $post, $post_ID;
	$messages['issue'] = array(
		0 => '', //Unused. Messages start at index 1.
		1 => sprintf( __('Issue updated. <a href="%s">View issue</a>'), esc_url(get_permalink($post_ID)) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Issue updated.'),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Issue restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Issue published. <a href="%s">View Issue</a>'), esc_url(get_permalink($post_ID)) ),
		7 => __('Issue saved.'),
		8 => __('Issue submitted.'),
		9 => sprintf( __( 'Issue scheduled for: <strong>%1$s</strong>.' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Issue draft updated.' )
	);

	return $messages;

}

// Displaying custom post types on the front page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'feature' ) );
	return $query;
}


// Add theme support for post format chat
add_action( 'after_setup_theme', 'add_post_formats_support', 11 );

function add_post_formats_support() {
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'chat' ) );
}

// Styling chat post
function styling_chat_post($table_talk) {
	global $post;
	if(has_post_format('chat')) {
		$chat_output = "<ul class=\"chat\">\n";
		$chat_output .= "</ul>\n";
		$$table_talk = $chat_output;
		return $table_talk;
	} else {
		return 'blah';
	}
}

// Add child theme javascript files
function register_js_scripts() {
	wp_register_script('picturefill', get_stylesheet_directory_uri() . '/js/picturefill.min.js');
	wp_register_script('custom_nav_searchbutton', get_stylesheet_directory_uri() . '/js/navigation.js');
}
add_action('init', 'register_js_scripts');

function add_js_scripts() {
	wp_print_scripts('custom_nav_searchbutton');
}
add_action('wp_footer', 'add_js_scripts');

// Add picturefill js for responsive/adaptive images
function mytheme_dequeue_scripts() {
	wp_dequeue_script('picturefill', plugins_url( '/js/picturefill.js', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'mytheme_dequeue_scripts');

// Image sizes
function add_image_sizes() {
	add_image_size('hero_small', 320, 205, array( 'right', 'bottom') );
	add_image_size('hero_small_2x', 640, 410, array( 'right', 'bottom') );
}
add_action('after_setup_theme', 'add_image_sizes');

// Remove Posts from admin menu bar
function remove_menu_pages() {
	remove_menu_page('edit.php');
}
add_action('admin_menu', remove_menu_pages);