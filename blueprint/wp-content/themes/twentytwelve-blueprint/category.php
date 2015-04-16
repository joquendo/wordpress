<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php $category_id = get_cat_ID( single_cat_title( '', false ) ); ?>
	<header class="archive-header">
		<span class="post-type"><?php printf( _e( 'Topic', 'twentytwelve' ) ); ?></span>
		<h1 class="archive-title"><?php printf( single_cat_title( '', false ) ); ?></h1>

	<?php if ( category_description() ) : // Show an optional category description ?>
		<div class="archive-meta"><?php echo category_description(); ?></div>
	<?php endif; ?>
	</header><!-- .archive-header -->

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php /* Loop through featured custom post type */

			// Loop arguments
			$args = array(
				'cat' => $category_id,
				'post_type' => 'feature',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			// Our featured query and loop
			$featured_query = new WP_Query( $args );

		?>

		<?php if ( $featured_query->have_posts() ) : ?>
			
			<div id="featured">
			<?php $obj = get_post_type_object( 'feature' ); ?>
				<span class="post-type"><?php echo $obj->labels->name; ?></span>

			<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();

				get_template_part( 'content', get_post_format() );

				// Featured loop ends
				endwhile;

				//Resetting
				wp_reset_postdata();
			?>
			
			</div><!-- End featured div -->
		
		<?php endif; ?>


		<?php /* Loop through sketches custom post type */

			// Loop arguments
			$args = array(
				'cat' => $category_id,
				'post_type' => 'sketch',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			// Our featured query and loop
			$sketch_query = new WP_Query( $args );

		?>

		<?php if ( $sketch_query->have_posts() ) : ?>

			<div id="sketches">
				<?php $obj = get_post_type_object( 'sketch' ); ?>
				<span class="post-type"><?php echo $obj->labels->name; ?></span>

			<?php /* Start the Loop */ ?>
			<?php while ( $sketch_query->have_posts() ) : $sketch_query->the_post();
				
				get_template_part( 'content', get_post_format() );
			
				// Sketch loop ends
				endwhile; 
					
				//Resetting
				wp_reset_postdata();
			?>

			</div> <!-- End sketches div -->

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>