<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$about_us_id = get_id_by_slug('about'); //RETRIEVES ID OF PAGE/POST WITH SLUG - FUNCTIONS.PHP
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="siteinfo">
			<div class="column first">
				<div class="content">
					<h6>About Us</h6>
					<p><?php echo wp_trim_words(get_post_field('post_content', $about_us_id), 50, '...');?> <a href="/about">MORE</a></p>
				</div>
				<div class="content">
					<p><a href="/staff-and-contributors">Staff and Contributors</a></p>
				</div>
			</div>
			
			<div class="column middle">
				<div class="content">
					<h6>Partners</h6>
					<?php wp_nav_menu( array('menu' => 'Partners' )); ?>
				</div>
				<div class="content">
					<h6>Contact Us</h6>
					<p>
						<?php echo get_field('street_address', $about_us_id); ?><br/>
						<?php echo get_field('city', $about_us_id); ?>, <?php echo get_field('state', $about_us_id); ?> <?php echo get_field('zip', $about_us_id); ?>
					</p>
					<p>
						P: <?php echo get_field('phone', $about_us_id); ?><br/>
						E: <a href="mailto:<?php echo get_field('email', $about_us_id); ?>"><?php echo get_field('email', $about_us_id); ?></a>
					</p>
				</div>
			</div>
			
			<div class="column last">
				<div class="content">
					<h6>Stay Informed</h6>
					<p>Subscribe and receive updates every time we publish a new issue. lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<?php echo do_shortcode('[contact-form-7 id="194" title="Stay Informed"]');?>
				</div>
				<div class="content">
					<p><a href="https://twitter.com/<?php echo get_field('twitter_username', $about_us_id); ?>">Receive Updates on Twitter</a></p>
					<p><a href="<?php bloginfo('rss2_url'); ?>">Receive Updates via RSS</a></p>
				</div>
			</div>
		</div><!-- .site-info -->

		<div class="legal">
			&copy;<?php echo date('Y');?> UC Regents, All Rights Reserved
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>