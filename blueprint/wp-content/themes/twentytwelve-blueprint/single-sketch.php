<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<div id="in-topics">
					<p class="entry-meta"><span class="title">In topics:</span><?php twentytwelve_entry_meta(); ?></p>
				</div>

				<div id="author-bio">
					<?php $staff_image = get_field('staff_image', 'user_'.get_the_author_meta('ID')); ?>
					<img class="staff-image" src="<?php echo $staff_image['url']; ?>" alt="<?php echo get_the_author_meta('display_name'); ?>" />
					<p class="staff-name"><?php echo get_the_author_meta('display_name'); ?></p>
					<p class="staff-title"><?php echo the_field('staff_title', 'user_'.get_the_author_meta('ID')); ?></p>
					<p class="staff-bio"><?php echo get_the_author_meta('description'); ?></p>
				</div>

				<?php comments_template( '', true ); ?>
			
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
				<?php
				$post_object = get_field('related_article');

				if( $post_object ): 
					// override $post
					$post = $post_object;
					setup_postdata( $post ); 
				?>
				<div id="related-article">
					<h2 class="post-type">Related</h2>
					<?php if ( get_field('thumbnail') ) : ?>
						<div class="entry-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php the_field('thumbnail'); ?>" alt="" /></a></div>
					<?php elseif ( 'sketch' == get_post_type() ) : ?>
						<div class="sketch-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-editors-note.png" alt="" /></a></div>
					<?php endif; ?>
					<div class="entry-summary <?php ( get_field('thumbnail') ) ? print 'has-image' : print '' ?> <?php ( 'sketch' == get_post_type() ) ? print 'has-sketch-image' : print '' ?>">
						<?php if ( get_field('article_type') ) : ?>
							<span class="article-type"><?php echo get_field('article_type'); ?></span>
						<?php endif; ?>	
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
						<?php the_excerpt(); ?>
						<p class="entry-meta"><?php twentytwelve_entry_meta(); ?></p>
					</div>
				</div>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>