<?php

include_once(__DIR__.'/func/func-sidebar.php');

// Setup a child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
	wp_enqueue_style( 'sidebar-style',  get_stylesheet_directory_uri() . '/css/sidebar.css', array('parent-style') );
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
	wp_enqueue_script( 'custom_sidebar', get_stylesheet_directory_uri() . '/js/sidebar.js', array( 'jquery' ) );
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

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

// Remove Posts from admin menu bar
function remove_menu_pages() {
	remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_menu_pages');
