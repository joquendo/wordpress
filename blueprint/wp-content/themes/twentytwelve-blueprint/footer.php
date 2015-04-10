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

$about_us_id = get_id_by_slug('about');
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<h3>About Us</h3>
			<p><?php echo wp_trim_words(get_post_field('post_content', $about_us_id), 20, '...');?> <a href="/about">MORE</a></p>
			<h3>Contact Us</h3>
			<p>
				<?php echo get_field('street_address', $about_us_id); ?><br/>
				<?php echo get_field('city', $about_us_id); ?>, <?php echo get_field('state', $about_us_id); ?> <?php echo get_field('zip', $about_us_id); ?>
			</p>
			<p>
				P: <?php echo get_field('phone', $about_us_id); ?><br/>
				E: <a href="mailto:<?php echo get_field('email', $about_us_id); ?>"><?php echo get_field('email', $about_us_id); ?></a>
			</p>
			<p><a href="https://twitter.com/<?php echo get_field('twitter_username', $about_us_id); ?>">Twitter</a></a>

			<h3>Stay Informed</h3>
			<?php echo do_shortcode('[contact-form-7 id="193" title="Stay Informed"]');?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>