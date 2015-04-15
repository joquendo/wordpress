<?php
get_header(); 

//retrieve meta values for the page
wp_reset_query();
$infographic_id     = get_the_ID();
$title        = get_the_title();
$header_image = get_field('infographic',$infographic_id);
$issue        = get_field('issue', $infographic_id);
?>





<div class="infographic-wrapper">
	
	<div class="content">
		
		<h3>Visually Speaking</h3>
		
		<h1 class="entry-title"><?php echo $title ?></h1>
		
		<img class="header" src="<?php echo $header_image['url'] ?>" />
		
		<div class="icon-container">
			<span class="icon-expand lightbox-open">
				<input type="hidden" name="infographic" value="<?php echo $header_image['url'] ?>" />
				<input type="hidden" name="title" value="<?php echo $title ?>" />
				<input type="hidden" name="issue" value="<?php echo $issue->post_title ?>" />
			</span>
			<span class="icon-download"></span>
		</div>
		
		<p class="tag-issue">
			Crime, Organized. Summer 2016, ISSUE #6
		</p>
		
	</div>

</div>





<?php get_footer(); ?>