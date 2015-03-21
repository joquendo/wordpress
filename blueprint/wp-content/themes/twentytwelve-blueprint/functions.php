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
		'labels' => post_type_labels( 'Book' ),
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

	register_post_type( 'book', $args);
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

// Add filter to ensure the text Book, or book, is displayed when user updates a book
add_filter('post_updated_messages', 'post_type_updated_messages');

function post_type_updated_messages($messages) {
	global $post, $post_ID;
	$messages['book'] = array(
		0 => '', //Unused. Messages start at index 1.
		1 => sprintf( __('Book updated. <a href="%s">View book</a>'), esc_url(get_permalink($post_ID)) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Book updated.'),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Book published. <a href="%s">View Book</a>'), esc_url(get_permalink($post_ID)) ),
		7 => __('Book saved.'),
		8 => __('Book submitted.'),
		9 => sprintf( __( 'Book scheduled for: <strong>%1$s</strong>.' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Book draft updated.' )
	);

	return $messages;

}

// Displaying custom post types on the front page

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'book', 'feature' ) );
	return $query;
}
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );


// Add theme support for post format chat

// First remove action from parent theme to override
remove_action( 'after_setup_theme', 'add_post_formats_support' );

function add_post_formats_support() {
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'chat' ) );
}
add_action( 'after_setup_theme', 'add_post_formats_support', 11 );

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
function add_js_scripts() {
	wp_register_script('custom_nav_searchbutton', get_stylesheet_directory_uri() . '/js/navigation.js')
	wp_enqueue_script('custom_nav_searchbutton');
}
add_action('wp_enqueue_scripts', 'add_js_scripts');



/*
// Rename post formats
function rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
        'Audio'  => 'Podcast',
        'Status' => 'Tweet'
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);*/