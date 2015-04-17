<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
global $issueID;

get_header(); 
?>





<div id="primary" class="site-content">
	
	<div id="content" role="main">
		
		<?php /* Loop through featured custom post type */

		// Setting a temporary value to avoid errors
		$do_not_duplicate = null;
		// Loop arguments
		$args = array(
			'post_type'  => 'feature',
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
			'meta_query' => array(
				array (
					'key'   => 'issue',
					'value' => $issueID
				)
			)
		);
		
		// Our featured query and loop
		$featured_query = new WP_Query( $args );
		?>
		
		<?php if ( $featured_query->have_posts() ) : ?>
			
			<div id="featured">

				<span class="post-type">Features</span>
			
				<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
					
					// Save the post ID to $do_not_duplicate
					$do_not_duplicate[] = $post->ID;
					?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php
				// Featured loop ends
				endwhile;

				//Resetting
				wp_reset_postdata();
			?>
			
			</div><!-- End featured div -->
		
		<?php endif; ?>
		
		
		
		
		
		<?php /* Loop through sketch post type */ ?>	
		
		<?php
		// Loop arguments
		$args = array(
			'post_type'  => 'sketch',
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
			'meta_query' => array(
				array (
					'key'   => 'issue',
					'value' => $issueID
				)
			)
		);
		
		// Our featured query and loop
		$sketches_query = new WP_Query( $args );
		?>

		<?php if ( $sketches_query->have_posts() ) : ?>

			<div id="sketches">
			
				<?php $obj = get_post_type_object( 'sketch' ); ?>
				<span class="post-type"><?php echo $obj->labels->name; ?></span>

			<?php // Start the Loop ?>
			<?php while ( $sketches_query->have_posts() ) : $sketches_query->the_post(); ?>
				<?php if ( 'sketch' == get_post_type() ) :
					get_template_part( 'content', 'sketch' );
				endif; ?>
			<?php endwhile; ?>

			</div> <!-- End sketches div -->

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php //get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check   ?>
		
		
	</div>
</div>





<?php get_sidebar(); ?>
<?php get_footer(); ?>