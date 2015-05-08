<?php

include_once(__DIR__.'/func/func-sidebar.php');



// Add child theme CSS files
function theme_enqueue_styles() {
	wp_enqueue_style( 'fonts-style',  get_stylesheet_directory_uri() . '/css/fonts.css');
	wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css', array('fonts-style') );
	wp_enqueue_style( 'staff-and-contributors-style',  get_stylesheet_directory_uri() . '/css/staff-and-contributors.css', array('child-style') );
	wp_enqueue_style( 'sidebar-style',  get_stylesheet_directory_uri() . '/css/sidebar.css', array('child-style','twentytwelve-style') );
	wp_enqueue_style( 'footer-style',  get_stylesheet_directory_uri() . '/css/footer.css', array('child-style','twentytwelve-style') );
	wp_enqueue_style( 'issue-style',  get_stylesheet_directory_uri() . '/css/issue.css', array('child-style') );
	wp_enqueue_style( 'comment-style',  get_stylesheet_directory_uri() . '/css/comment.css', array('child-style','twentytwelve-style') );
	wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . '/css/slick.css', array('child-style', 'twentytwelve-style') );
	wp_enqueue_style( 'slick-theme-style', get_stylesheet_directory_uri() . '/css/slick-theme.css', array('child-style', 'twentytwelve-style') );
	wp_enqueue_style( 'ie8-style', get_stylesheet_directory_uri() . '/css/ie8.css', array('child-style', 'twentytwelve-style') );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



// Remove custom font enabled in twentytwelve theme
function remove_open_sans() {
   wp_dequeue_style( 'twentytwelve-fonts' );
}
add_action('wp_print_styles','remove_open_sans');



// Add custom post types to default query
function add_my_post_types_to_query( $query ) {
	// Check if home, category, tag, or main query. && empty( $query... ) was added to supress errors with menu
	if ( ( is_home() || is_category() || is_tag() ) && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] ) )
		$query->set( 'post_type', array( 'feature', 'sketch' ) );
		$query->set( 'orderby', 'menu_order');
		$query->set( 'order', 'ASC');
	return $query;
}
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );



// dequeue default navigation.js (Using maing.js instead)
function dequeue_navigation() {
	wp_dequeue_script( 'twentytwelve-navigation' );
}
add_action('wp_print_scripts','dequeue_navigation');



// Add child theme javascript files
function register_js_scripts() {
	// Using main.js for navigation and other UI elements
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/main.js' );
	
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', array() );
	wp_enqueue_script( 'custom_search', get_stylesheet_directory_uri() . '/js/search.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom_footer', get_stylesheet_directory_uri() . '/js/footer.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom_comment', get_stylesheet_directory_uri() . '/js/comment.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'imagesloaded-pkgd', get_stylesheet_directory_uri() . '/js/vendor/imagesloaded/imagesloaded.pkgd.js', array( 'jquery' ) );
	wp_enqueue_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/vendor/imagesloaded/imagesloaded.js', array( 'jquery', 'imagesloaded-pkgd' ) );
	wp_enqueue_script( 'custom_sidebar', get_stylesheet_directory_uri() . '/js/sidebar.js', array( 'jquery', 'imagesloaded' ) );
	wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/vendor/slick/slick.min.js', array( 'jquery'), '1.0.0', true );
}
add_action('init', 'register_js_scripts');



// enqueue main.js to load in footer
function add_custom_scripts() {
	wp_print_scripts('main');
}
add_action('wp_footer', 'add_custom_scripts');



// Add the new menu -- May not be used anymore
register_nav_menus( array(
	'primary' => __( 'Top Menu (Above Header)', 'twentytwelve' ),
	'secondary' => __( 'Secondary (Issues)', 'twentytwelve')
) );



// Image sizes -- May not be used anymore
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



/** Override twentytwelve_entry_meta()
 *
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

function admin_menu_items() {
    global $menu;
    $menu[21] = $menu[10]; // Move media menu from index 10 to index 21
    unset($menu[10]); // Clear index 10, media menu

    remove_menu_page('tools.php'); // Remove the Tools Menu
}
add_action('admin_menu', 'admin_menu_items');

// Removing "Add New" tab from admin menu navigation bar
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

//fomatting the meta catgories
function print_categories ($categories) {
	
	$separator = ' ';
	$output = '';
	
	if($categories){
		foreach($categories as $category) {
			$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" rel="category tag">'.$category->cat_name.'</a>'.$separator;
		}
		$topics_list = trim($output, $separator); //REUSE THIS VAR TO DISPLAY CATEGORIES
		echo $topics_list;
	} 
}

//Replace options default name with custom name Editor's Pick
if( function_exists('acf_set_options_page_title') )
{
    acf_set_options_page_title( __('Editor\'s Picks') );
}
if( function_exists('acf_set_options_page_menu') )
{
    acf_set_options_page_menu( __('Editor\'s Picks') );
}