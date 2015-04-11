<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>


		<?php if ( is_single() ) : ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

		<?php else : ?>

			<?php if ( is_search() || is_home() ) : // Only display Excerpts for Search or home page ?>
				
				<header class="entry-header">
					<?php if ( get_field('thumbnail') ) : ?>
					<div class="entry-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php the_field('thumbnail'); ?>" alt="" /></a></div>
					<?php elseif ( 'sketch' == get_post_type() ) : ?>
					<div class="sketch-image"><a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-editors-note.png" alt="" /></a></div>
					<?php endif; ?>
					<div class="entry-summary <?php ( get_field('thumbnail') ) ? print 'has-image' : print '' ?> <?php ( 'sketch' == get_post_type() ) ? print 'has-sketch-image' : print '' ?>">
						<?php if ( get_field('article_type') ) : ?>
						<span class="article-type"><?php echo get_field('article_type'); ?></span>
						<?php endif; ?>	
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						<?php the_excerpt(); ?>
						<p class="entry-meta"><?php twentytwelve_entry_meta(); ?></p>
					</div><!-- .entry-summary -->

				</header>

			<?php endif; ?>

		<?php endif; ?>

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
