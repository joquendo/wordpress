<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//grab the issueID; 
global $issueID, $post_type;

//if the post type is issue store the issueID
$post_type = get_post_type();
if($post_type === 'issue') $issueID = get_the_ID();
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php $upload_dir = wp_upload_dir(); ?>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">

		<?php 

		// Issues Drawer
		$menu_list = '<!-- Start menu-issues-container --><div class="menu-issues-container">';
		$menu_list .= '<div id="menu-issues" class="nav-menu">';

		// Note: There is a filter overriding the WP_Query request by appending ORDER BY wp_posts.menu_order ASC
		$args = array (
			'post_type' => 'issue',
			'orderby' => 'post_date', //orderby not working due to some override (possibly Simple Page Ordering plugin)
			'order' => 'ASC' //order not working due to some override (possibly Simple Page Ordering plugin)
		);

		// Fix: Removing override and appending 'ORDER BY wp_posts.post_date ASC' to WP_Query request
		add_filter( 'posts_orderby', 'filter_query' );

		function filter_query( $query ) {
			$query = 'wp_posts.post_date ASC';
			return $query;
		}; // End removing override

		// WP_Query for issues
		$published_issues = new WP_Query( $args );

		while ( $published_issues->have_posts() ) : $published_issues->the_post();
			
			$issue_id			= get_the_ID();
			$cover_image_url	= get_field('cover_image', $issue_id);
			$issue_date			= get_field('issue_date', $issue_id);
			$pdf				= get_field('pdf_download', $issue_id);
			$url				= get_permalink($issue_id);

			$menu_list .= '<div class="menu-item">';

			if ( ! empty($cover_image_url) ) :
				$menu_list .= '<img src="' . $cover_image_url . '" />';
			else :
				$menu_list .= '<img src="' . get_stylesheet_directory_uri() . '/images/fpo-issue-cover.png" />';
			endif;

			$menu_list .= '<div class="hover"><a href="' . $url . '">View</a><a href="' . $pdf . '">Download</a></div>';
			$menu_list .= '<span>' . $issue_date . '</span>';
			$menu_list .= '</div>'; // End menu item

		endwhile;

		$menu_list .= '</div>';
		$menu_list .= '</div><!-- End menu-issues-container -->';

		echo $menu_list;

		wp_reset_postdata();

		// End Issues Drawer

		?>


		<div class="wrapper">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="UCLA Blueprint" /></a>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle menu-menu"><span class="nav-menu"></span></button>			
				<button class="menu-toggle menu-topics"><span class="nav-topic">Topics</span></button>
				<button class="menu-toggle menu-issues"><span class="nav-issue">Issues</span></button>
				<button class="menu-toggle menu-search"><span class="nav-search">Search</span></button>

				<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
				
				<!-- Topics navigation dropdown menu (Categories list) -->
				<div class="menu-topics-container">
					<ul id="menu-topics" class="nav-menu">
						<?php wp_list_categories('title_li='); ?>
					</ul>
				</div>
				
				<div id="searchform">
					<label for="search-query">What are you searching for?</label>
					<input type="text" id="search-query" name="search-query" /><!--
					--><button type="button" id="submit-search-query">Go</button>
				</div>
			</nav><!-- #site-navigation -->
		</div>

		<div class="header-image-container">

			<?php

				/* Homepage/front page only - Load hero image from latest issue */
				if ( is_home() ) :

					// New WP_Query loop for a single post
					$latest_post = new WP_Query( 'post_type=issue&posts_per_page=1' );

					// Get hero image from latest issue post
					while( $latest_post->have_posts() ) : $latest_post->the_post();
						$hero_image = get_field('hero_image');
						$issueID = get_the_ID();
				 	endwhile;

				else :

					// Hero image
					$hero_image = get_field('hero_image');

				endif; 

			?>
			<?php

				if ( !empty($hero_image) ) : 
					$hero_image_id = $hero_image['id'];
					$hero_image_url = $hero_image['url'];
				else :
					if(get_post_type() == 'feature') {
						$hero_image_url = get_stylesheet_directory_uri() . '/images/fpo-feature-hero.png';
					} else {
						$hero_image_url = get_stylesheet_directory_uri() . '/images/fpo-issue-hero.png';
					}
				endif;

				// Mobile hero image
				$mobile_hero = get_field('mobile_hero');

				if ( !empty( $mobile_hero ) ) :
					$mobile_hero = get_field('mobile_hero');
					$mobile_hero_url = $mobile_hero['url'];
				else:
					if(get_post_type() == 'feature') {
						$mobile_hero_url = get_stylesheet_directory_uri() . '/images/fpo-feature-hero-mobile.png';
					} else {
						$mobile_hero_url = get_stylesheet_directory_uri() . '/images/fpo-issue-hero-mobile.png';
					}
				endif;
			?>
				
			<?php /*Issue or feature page (with hero image) */

			if ( 'issue' == get_post_type() || 'feature' == get_post_type() && ! is_category() ) : ?>

				<picture>
					<?php if ( !empty($hero_image) ) : ?>
					<source media="(min-width:737px)" <?php echo tevkori_get_srcset_string( $hero_image_id, 'full' ); ?> />
					<?php else : ?>
					<source media="(min-width:737px)" srcset="<?php echo $hero_image_url; ?>" />
					<?php endif; ?>
					<source srcset="<?php echo $mobile_hero_url; ?>" />
					<img src="<?php echo $hero_image_url; ?>" alt="<?php echo $hero_image['alt']; ?>" class="header-image" />
				</picture>

			<?php endif; ?>
				
		</div>

		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<?php if ( $featured_article = get_field('featured_article') ) : ?>

		<div class="wrapper">
			<div class="issue">
				<span class="featured-article-title"><?php bloginfo( 'description' ); ?></span><br/>
				<span><font class="issue-num">Issue #<?php echo get_field('issue_number')?></font> &nbsp; <?php echo get_field('issue_date'); ?></span>
				<a href="<?php echo get_permalink($featured_article->ID); ?>"><span class="title"><?php echo the_title(); ?></span></a>
			</div>
			
			<?php if ( $event_id = getLatestEventID() ) : ?>
			
				<?php
				$title = get_the_title( $event_id );
				$premalink = get_permalink($event_id);
				?>
				
				<div class="event">
					<span>Next Event</span>
					<a href="<?php echo $premalink ?>"><span class="title"><?php echo $title ?></span></a>
				</div>
			<?php endif; ?>
		</div>

		<?php endif; ?>

	</header><!-- #masthead -->
	
	<div id="main" class="wrapper">