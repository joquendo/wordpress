<?php

get_header(); 

//retrieve meta values for the page
wp_reset_query();
$event_id     = get_the_ID();
$title        = get_the_title();
$header_image = get_field('header_image',$event_id);
$introduction = get_field('introduction',$event_id);
$date         = date( 'l, F j, Y', strtotime( get_field('date',$event_id) ) );
$time_copy    = get_field('time_copy',$event_id);
$address      = get_field('address',$event_id);
$parking_info = get_field('parking_info',$event_id);
$map_url      = get_field('google_map_url',$event_id);
$register_url = get_field('register_url',$event_id);
$description  = get_field('description',$event_id);
?>

<div class="event-wrapper">
	
	<div class="content">
		
		<h3>Next Event</h3>
		
		<h1><?php echo $title ?></h1>
		
		<img class="header" src="<?php echo $header_image['url'] ?>" />
		
		<p><?php echo $introduction ?></p>
		
		<p>
			<span class="subtitle"><?php echo $date ?></span><br/>
			<?php echo $time_copy ?>
		</p>
		
		<p>
			<span class="subtitle">Location &amp; Parking</span><br/>
			<?php echo $address ?> <a href="<?php echo $map_url ?>" target="_blank">Map</a><br/>
			<?php echo $parking_info ?>
		</p>
		
		<a class="btn" href="<?php echo $register_url ?>">Register Now</a>
		
		<p class="description"><?php echo $description ?></p>
		
		
		
		

		<?php if ( have_rows('moderator') ) : ?>
		
			<?php while ( have_rows('moderator') ) : the_row(); ?>
			
				<?php
				$profile = get_sub_field('profile_image');
				$name = get_sub_field('name');
				$title = get_sub_field('title');
				$blurb = get_sub_field('blurb');
				?>
				
				<div class="moderator clearfix">
				
					<div class="container">
						<div class="col-1">
							<img src="<?php echo $profile['url'] ?>" />
						</div>
						
						<div class="col-2">
							
							<span class="label">Moderator</span>
							
							<span class="name"><?php echo $name ?></span>
							
							<span class="title"><?php echo $title ?></span>
							
							<p><?php echo $blurb ?></p>
							
						</div>
					</div>
					
				</div>
			
			<?php endwhile; ?>
			
		<?php endif; ?>
		
		
		
		
		
		<?php if ( have_rows('panelist') ) : ?>
		
			<?php while ( have_rows('panelist') ) : the_row(); ?>
			
				<?php
				$profile = get_sub_field('profile_image');
				$name = get_sub_field('name');
				$title = get_sub_field('title');
				$blurb = get_sub_field('blurb');
				?>
				
				<div class="panelist clearfix">
				
					<div class="container">
						<div class="col-1">
							<img src="<?php echo $profile['url'] ?>" />
						</div>
						
						<div class="col-2">
							
							<span class="label">Panelist</span>
							
							<span class="name"><?php echo $name ?></span>
							
							<span class="title"><?php echo $title ?></span>
							
							<p><?php echo $blurb ?></p>
							
						</div>
					</div>
					
				</div>
			
			<?php endwhile; ?>
			
		<?php endif; ?>
		
	</div>
	
</div>


<?php get_footer(); ?>