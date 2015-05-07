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