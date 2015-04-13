<?php

include_once(__DIR__.'/func/func-sidebar.php');

// Setup a child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
	wp_enqueue_style( 'staff-and-contributors-style',  get_stylesheet_directory_uri() . '/css/staff-and-contributors.css', array('parent-style') );
	wp_enqueue_style( 'sidebar-style',  get_stylesheet_directory_uri() . '/css/sidebar.css', array('parent-style') );
	wp_enqueue_style( 'footer-style',  get_stylesheet_directory_uri() . '/css/footer.css', array('parent-style') );
}

// Remove custom font enabled in twentytwelve theme
function remove_open_sans() {
   wp_dequeue_style( 'twentytwelve-fonts' );
}
add_action('wp_print_styles','remove_open_sans');

// Displaying custom post types on the front page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
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
	wp_register_script('picturefill', get_stylesheet_directory_uri() . '/js/picturefill.min.js');
	wp_register_script('custom_navigation', get_stylesheet_directory_uri() . '/js/navigation.js');
	wp_enqueue_script( 'custom_sidebar', get_stylesheet_directory_uri() . '/js/sidebar.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom_footer', get_stylesheet_directory_uri() . '/js/footer.js', array( 'jquery' ) );
}
add_action('init', 'register_js_scripts');

// de-queue navigation js
function dequeue_navigation() {
	wp_dequeue_script( 'twentytwelve-navigation' );
}
add_action('wp_print_scripts','dequeue_navigation');

// enqueue custom navigation js
function add_custom_scripts() {
	wp_print_scripts('custom_navigation');
}
add_action('wp_footer', 'add_custom_scripts');

// Add the new menu
register_nav_menus( array(
	'primary' => __( 'Top Menu (Above Header)', 'twentytwelve' ),
	'secondary' => __( 'Secondary (Issues)', 'twentytwelve')
) );

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
		$utility_text = __( '%1$s <div> %2$s </div>', 'twentytwelve' );
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