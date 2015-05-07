<div id="author-bio">
	<?php 
		$staff_image = get_field('staff_image', 'user_'.get_the_author_meta('ID'));
		//STAFF IMAGE URL
		if ( !empty( $staff_image ) ) :
			$staff_image_url = $staff_image['url'];
			$staff_image_alt = get_the_author_meta('display_name');
		else:
			$staff_image_url = get_stylesheet_directory_uri() . "/images/fpo-avatar.png";
			$staff_image_alt = "Image Needed";
		endif; 
	?>
	<img class="staff-image" src="<?php echo $staff_image_url; ?>" alt="<?php echo $staff_image_alt; ?>" />
	<p class="staff-name"><?php echo get_the_author_meta('display_name'); ?></p>
	<p class="staff-bio"><?php echo get_the_author_meta('description'); ?></p>
</div>