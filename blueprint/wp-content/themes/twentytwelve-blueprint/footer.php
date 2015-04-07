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
			<p><?php echo wp_trim_words(get_post_field('post_content', $about_us_id), 30, '...');?> <a href="/about">MORE</a></p>
			<h3>Contact Us</h3>
			<p>
				<?php echo get_post_meta($about_us_id, 'street_address', true); ?><br/>
				<?php echo get_post_meta($about_us_id, 'city', true); ?>, <?php echo get_post_meta($about_us_id, 'state', true); ?> <?php echo get_post_meta($about_us_id, 'zip', true); ?>
			</p>
			<p>
				P: <?php echo get_post_meta($about_us_id, 'phone', true); ?><br/>
				E: <a href="mailto:<?php echo get_post_meta($about_us_id, 'email', true); ?>"><?php echo get_post_meta($about_us_id, 'email', true); ?></a>
			</p>
			<p><a href="https://twitter.com/<?php echo get_post_meta($about_us_id, 'twitter_username', true); ?>">Twitter</a></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>