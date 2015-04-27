<?php

include_once(__DIR__.'/func/func-sidebar.php');

// Setup a child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
	wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style( 'staff-and-contributors-style',  get_stylesheet_directory_uri() . '/css/staff-and-contributors.css', array('child-style') );
	wp_enqueue_style( 'sidebar-style',  get_stylesheet_directory_uri() . '/css/sidebar.css', array('child-style') );
	wp_enqueue_style( 'footer-style',  get_stylesheet_directory_uri() . '/css/footer.css', array('child-style','twentytwelve-style') );
	wp_enqueue_style( 'issue-style',  get_stylesheet_directory_uri() . '/css/issue.css', array('child-style') );
	wp_enqueue_style( 'comment-style',  get_stylesheet_directory_uri() . '/css/comment.css', array('child-style','twentytwelve-style') );
}

// Remove custom font enabled in twentytwelve theme
function remove_open_sans() {
   wp_dequeue_style( 'twentytwelve-fonts' );
}
add_action('wp_print_styles','remove_open_sans');

// Displaying custom post types on the front page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( ( is_home() || is_category() || is_tag() ) && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] ) )
		$query->set( 'post_type', array( 'feature', 'sketch' ) );
		$query->set( 'orderby', 'menu_order');
		$query->set( 'order', 'ASC');
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
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/main.js' );
	wp_enqueue_script( 'custom_search', get_stylesheet_directory_uri() . '/js/search.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom_footer', get_stylesheet_directory_uri() . '/js/footer.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom_comment', get_stylesheet_directory_uri() . '/js/comment.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'imagesloaded-pkgd', get_stylesheet_directory_uri() . '/js/vendor/imagesloaded/imagesloaded.pkgd.js', array( 'jquery' ) );
	wp_enqueue_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/vendor/imagesloaded/imagesloaded.js', array( 'jquery', 'imagesloaded-pkgd' ) );
	wp_enqueue_script( 'custom_sidebar', get_stylesheet_directory_uri() . '/js/sidebar.js', array( 'jquery', 'imagesloaded' ) );
}
add_action('init', 'register_js_scripts');

// de-queue navigation js - using main js
function dequeue_navigation() {
	wp_dequeue_script( 'twentytwelve-navigation' );
}
add_action('wp_print_scripts','dequeue_navigation');

// enqueue main js
function add_custom_scripts() {
	wp_print_scripts('main');
}
add_action('wp_footer', 'add_custom_scripts');

// Add the new menu
register_nav_menus( array(
	'primary' => __( 'Top Menu (Above Header)', 'twentytwelve' ),
	'secondary' => __( 'Secondary (Issues)', 'twentytwelve')
) );

// Image sizes
function add_image_sizes() {
	add_image_size( 'mobile', 736, 460 );
	add_image_size( 'mobile_2x', 1472, 920 );  
	add_image_size( 'large_1280', 1280, 416 );
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

/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ' ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ' ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = '';
	} elseif ( $categories_list ) {
		$utility_text = __( '%1$s', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}

function blueprint_get_categories () {
	$categories_list = get_the_category_list( __( ' ', 'twentytwelve' ) );
	if ( $categories_list != 'Uncategorized') {
		printf( $categories_list );
	}
}

//Comment Form Filter
add_filter( 'comment_form_defaults', 'comment_form_defaults_function', 10 , 1 );
function comment_form_defaults_function ($defaults) {
	
	$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Your thoughts', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea></p>';
	$defaults['label_submit'] = __( 'Post' );
	
	return $defaults;
}

add_filter( 'comment_reply_link_args', 'comment_reply_link_args_function', 10, 1 );
function comment_reply_link_args_function($args) {
	$args['after'] = ' <span>&gt;</span>';
	return $args;
}

function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('feature', 'sketch', 'infographic');
	return $qv;
}
add_filter('request', 'myfeed_request');