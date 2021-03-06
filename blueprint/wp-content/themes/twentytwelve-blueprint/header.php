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
?><!DOCTYPE html>
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
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><span class="dashicons dashicons-menu"></span></button>

			<button class="menu-toggle"><span class="dashicons dashicons-search"></span></button>
			
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			<?php get_search_form(); ?>
		</nav><!-- #site-navigation -->


		<div class="header-image-container">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="UCLA Blueprint" /></a>
			</div>



			<?php $hero_image = get_field('hero_image');

			if ( is_home() || ( is_single() && empty($hero_image) ) ) :

				// New WP_Query loop for a single post
				$latest_post = new WP_Query( 'post_type=issue&posts_per_page=1' );

				while( $latest_post->have_posts() ) : $latest_post->the_post();
					// Get hero image from latest issue post
					$hero_image = get_field('hero_image');

			 	endwhile;

			endif; 

			if ( !empty($hero_image) ) : ?>

				<picture>
					<source media="(min-width:36em)" <?php echo tevkori_get_srcset_string( $hero_image['id'], 'full' ); ?> />
					<source <?php echo tevkori_get_srcset_string( $hero_image['id'], 'hero_small' ); ?> />
					<img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" class="header-image" />
				</picture>

			<?php endif; ?>

		</div>

		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

	</header><!-- #masthead -->

	<div id="main" class="wrapper">