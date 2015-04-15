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
 
global $issueID;
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
<meta name="viewport" content="width=device-width" />
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
		<div class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="UCLA Blueprint" /></a>
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle menu-menu"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-menu.png"/><span class="nav-menu"></span></button>			
			<button class="menu-toggle menu-topics"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-topic.png" /><span class="nav-topic">Topics</span></button>
			<button class="menu-toggle menu-issues"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-issue.png" /><span class="nav-issue">Issues</span></button>
			<button class="menu-toggle menu-search"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-search.png" /><span class="nav-search">Search</span></button>

			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			<?php 

				$menu_name = 'secondary';

				if ( ($locations = get_nav_menu_locations() ) && isset ( $locations[ $menu_name ] ) ) {
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					$menu_list  = '<div class="menu-issues-container">';

						$menu_list .='<div id="menu-' . $menu->slug . '" class="nav-menu">';
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$cover_image_url = get_field('cover_image', $menu_item->object_id);
								$issue_date = get_field('issue_date', $menu_item->object_id);
								$pdf = get_field('pdf_download', $menu_item->object_id);
								$url = $menu_item->url;
								$menu_list .= '<div class="menu-item">';
									$menu_list .= '<img src="' . $cover_image_url . '" />';
									$menu_list .= '<div class="hover"><a href="' . $url . '">View</a><a href="' . $pdf . '">Download</a></div>';
									$menu_list .= '<span>' . $issue_date . '</span>';
								$menu_list .= '</div>'; // End menu item
							}

						$menu_list .='</div>'; // End menu-{menu->slug}

					$menu_list .='</div>'; // End menu-issues-container

				} else {

					$menu_list = '<div class="menu-issues-container"><ul><li>Menu "' . $menu_name . '" not defined.</li></ul></div>';

				}

				echo $menu_list;

			 ?>
			<div id="searchform">
				<label for="search-query">What are you searching for?</label>
				<input type="text" id="search-query" name="search-query" /><!--
				--><button type="button" id="submit-search-query">Go</button>
			</div>
		</nav><!-- #site-navigation -->


		<div class="header-image-container">

			<?php $hero_image = get_field('hero_image');

			if ( is_home() || ( is_single() && empty($hero_image) ) ) :

				// New WP_Query loop for a single post
				$latest_post = new WP_Query( 'post_type=issue&posts_per_page=1' );

				while( $latest_post->have_posts() ) : $latest_post->the_post();
					// Get hero image from latest issue post
					$hero_image = get_field('hero_image');
					$issueID = get_the_ID();
			 	endwhile;

			endif; 

			if ( !empty($hero_image) ) : ?>

				<picture>
					<source media="(min-width:36em)" <?php echo tevkori_get_srcset_string( $hero_image['id'], 'full' ); ?> />
					<?php if ( $mobile_hero_image = get_field('mobile_hero_image') ): ?>
					<source srcset="<?php echo $mobile_hero_image['url']; ?>" />
					<?php endif; ?>
					<img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" class="header-image" />
				</picture>

			<?php endif; ?>

		</div>

		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<?php if (get_field('featured_article')) :
			$featured_article = get_field('featured_article');
		?>
			<div class="issue">
				<span><?php echo get_field('issue_date'); ?> Issue</span>
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
			
		<?php endif; ?>

	</header><!-- #masthead -->
	
	<div id="main" class="wrapper">