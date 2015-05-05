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

/**
 * BLUEPRINT_STAFF AND CONTRIBUTORS ARE REPEATING FIELDS WITH AN OBJECT THAT IS LOADED FROM THE 'USER' TYPE WITHIN WORDPRESS ADMIN
 * THE 'USER' OBJECT HAS DISPLAY_NAME, USER_DESCRIPTION, WHILE STAFF_TITLE AND STAFF_IMAGE ARE CUSTOM FIELDS ADDED TO THE 'USER' TYPE
 * UCLA ADMINISTRATORS ARE ENTERED ON THE 'STAFF AND CONTRIBUTORS' PAGE VIA A REPEATING FIELD
 */
get_header(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>

				<!-- BLUE PRINT STAFF MEMBERS -->
				<?php if( have_rows('blueprint_staff') ): ?>

				<h2 class="section-title">Blueprint Staff</h2>

					<div class="staff-listing">
						<ul class="staff-members">

							<?php while( have_rows('blueprint_staff') ): the_row(); 
								// vars
								$staff_member = get_sub_field('staff_member');
								$staff_image = get_field('staff_image', 'user_'.$staff_member['ID']);
							?>

							<li>	
								<img class="staff-image" src="<?php echo $staff_image['url']; ?>" alt="<?php echo $staff_member['display_name']; ?>" />
								<p class="staff-name"><?php echo $staff_member['display_name']; ?></p>
								<p class="staff-title"><?php echo the_field('staff_title', 'user_'.$staff_member['ID']); ?></p>
								<p class="staff-bio"><?php echo $staff_member['user_description']; ?></p>
							</li>
								
							<?php endwhile; ?>

						</ul>
					</div>

				<?php endif; ?>

				<!-- BLUE PRINT CONTRIBUTORS -->
				<?php if( have_rows('contributors') ): ?>

				<h2 class="section-title">Contributors</h2>

					<ul class="staff-listing">

					<?php while( have_rows('contributors') ): the_row(); 
						// vars
						$contributor_member = get_sub_field('contributor_member');
					?>

						<li>
							<p class="staff-name"><?php echo $contributor_member['display_name']; ?>
							<?php if(get_field('staff_title', 'user_'.$contributor_member['ID'])): ?>
							 <span class="staff-title"><?php echo the_field('staff_title', 'user_'.$contributor_member['ID']); ?></span>
							<?php endif; ?>
							</p>
						</li>

					<?php endwhile; ?>

					</ul>

				<?php endif; ?>


				<!-- UCLA ADMINISTRATION -->
				<?php if( have_rows('ucla_administration') ): ?>

				<h2 class="section-title">UCLA Administration</h2>

					<ul class="staff-listing">

					<?php while( have_rows('ucla_administration') ): the_row(); 
						// vars
						$administrator_name = get_sub_field('administrator_name');
						$administrator_title = get_sub_field('administrator_title');
					?>

						<li>
							<p class="staff-name"><?php echo $administrator_name; ?><span class="staff-title"><?php echo $administrator_title; ?></span></p>
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


<?php get_footer(); ?>