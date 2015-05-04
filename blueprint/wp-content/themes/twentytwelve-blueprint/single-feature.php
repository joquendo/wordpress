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
					<p class="entry-meta"><span class="title">In topics:</span>
					<?php 
						$categories = get_the_category();
						$separator = ' ';
						$output = '';
						if($categories){
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" rel="category tag">'.$category->cat_name.'</a>'.$separator;
							}
							$topics_list = trim($output, $separator); //REUSE THIS VAR TO DISPLAY CATEGORIES
							echo $topics_list;
						} 
					?>
					</p>
					<p class="entry-meta tags"><span class="title">Tagged:</span><?php the_tags( '', ', ' ); ?></p>
				</div>

				<div id="author-bio">
					<?php $staff_image = get_field('staff_image', 'user_'.get_the_author_meta('ID')); ?>
					<img class="staff-image" src="<?php echo $staff_image['url']; ?>" alt="<?php echo get_the_author_meta('display_name'); ?>" />
					<p class="staff-name"><?php echo get_the_author_meta('display_name'); ?></p>
					<p class="staff-bio"><?php echo get_the_author_meta('description'); ?></p>
				</div>

				<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
				<?php
				$post_object = get_field('related_article');

				if( $post_object ): 
					// override $post
					$post = $post_object;
					setup_postdata( $post ); 
					$categories = get_the_category();
				?>
				<div class="related-article <?php echo get_field('article_type'); ?>">

					<span class="post-type">Related</span>

					<?php if ( get_field('thumbnail_image') ) : ?>
					<div class="entry-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php the_field('thumbnail_image'); ?>" alt="" /></a></div>
					<?php elseif ( !get_field('thumbnail_image') && 'feature' == get_post_type() ) : ?>
					<div class="entry-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fpo-thumbnail.png" alt="" /></a></div>
					<?php elseif ( 'sketch' == get_post_type() ) : ?>
					<div class="sketch-image"><a href="<?php the_permalink(); ?>" rel="bookmark"></a></div>
					<?php endif; ?>
					
					<div class="entry-summary has-image <?php ( 'sketch' == get_post_type() ) ? print 'has-sketch-image' : print '' ?>">
					<?php if ( get_field('article_type') ) : ?>
						<span class="article-type"><?php echo get_field('article_type'); ?></span>
					<?php endif; ?>	
						
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>

						<?php the_excerpt(); ?>

						<p class="entry-meta"><?php print_categories($categories); //SET 'IN TOPICS'?></p>
					</div>

				</div>

				<?php 
				wp_reset_postdata();
				comments_template( '', true ); 
				?>

				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>