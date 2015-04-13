<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>

				<!-- BLUE PRINT STAFF MEMBERS -->
				<?php if( have_rows('blue_print_staff') ): ?>

				<h2>Blueprint Staff</h2>

					<div class="staff-listing">
						<ul class="staff-members">

							<?php while( have_rows('blue_print_staff') ): the_row(); 
								// vars
								$staff_image = get_sub_field('staff_image');
								$staff_name = get_sub_field('staff_name');
								$staff_title = get_sub_field('staff_title');
								$staff_bio = get_sub_field('staff_bio');
							?>

							<li>	
								
									<img class="staff-image" src="<?php echo $staff_image['url']; ?>" alt="<?php echo $staff_image['alt'] ?>" />
									<p class="staff-name"><?php echo $staff_name; ?></p>
									<p class="staff-title"><?php echo $staff_title; ?></p>
									<p class="staff-bio"><?php echo $staff_bio; ?></p>
								
							</li>
								
							<?php endwhile; ?>

						</ul>
					</div>

				<?php endif; ?>

				<!-- BLUE PRINT CONTRIBUTORS -->
				<?php if( have_rows('contributors') ): ?>

				<h2>Contributors</h2>

					<ul>

					<?php while( have_rows('contributors') ): the_row(); 
						// vars
						$contributor_name = get_sub_field('contributor_name');
						$contributor_title = get_sub_field('contributor_title');
					?>

						<li>
							<p class="staff-name"><?php echo $contributor_name; ?> <span class="staff-title"><?php echo $contributor_title; ?></p>
						</li>

					<?php endwhile; ?>

					</ul>

				<?php endif; ?>


				<!-- UCLA ADMINISTRATION -->
				<?php if( have_rows('ucla_administration') ): ?>

				<h2>UCLA Administration</h2>

					<ul>

					<?php while( have_rows('ucla_administration') ): the_row(); 
						// vars
						$administrator_name = get_sub_field('administrator_name');
						$administrator_title = get_sub_field('administrator_title');
					?>

						<li>
							<p class="staff-name"><?php echo $administrator_name; ?> <span class="staff-title"><?php echo $administrator_title; ?></span></p>
						</li>

					<?php endwhile; ?>

					</ul>

				<?php endif; ?>

				<!-- SPECIAL NOTE x-->
				<?php if( get_field('special_note') ): ?>
					<p class="special-note"><?php the_field('special_note'); ?></p>
				<?php endif; ?>

				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>