<?php
/**
 * The sidebar containing the main widget area
 *
 *
 */
?>

<div id="secondary" class="widget-area" role="complementary" style="position:relative;">
	
	<?php if ( $event_id = getLatestEventID() ) : ?>
		<div class="container">
			
			<!-- EVENT CONTAINER START-->
			<div class="widget event">
				
				<h3>Next Event</h3>
				
				<?php
				$thumb = get_field('thumbnail',$event_id);
				$date = date( 'l, F j, Y', strtotime( get_field('date',$event_id) ) );
				$title = get_the_title( $event_id );
				?>
				
				<img class="thumbnail" src="<?php echo $thumb['url']?>" />
				
				<h4><?php echo $title ?></h4>
				
				<span class="date"><?php echo $date?></span>
				
				<a class="btn" href="">More Info</a>
				
			</div> <!-- EVENT CONTAINER END -->
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<?php if ( $infographic_id = getInfographicID() ) : ?>
		<div class="container">
			
			<!-- INFOGRAPHIC CONTAINER START-->
			<div class="widget event">
				
				<h3>Visually Speaking</h3>
				
				<?php
				$thumb = get_field('thumbnails', $infographic_id);
				$summary = get_field('summary', $infographic_id );
				$title = get_the_title($infographic_id);
				?>
				
				<img class="thumbnail" src="<?php echo $thumb['url']?>" />
				
				<h4><?php echo $title ?></h4>
				
				<p><?php echo $summary ?></p>
				
			</div> <!-- INFOGRAPHIC CONTAINER END -->
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<?php
	$newsworthy = getNewsworthy();
	?>
	
	<?php if ( $newsworthy = getNewsworthy() ) : ?>
		<div class="container">
			
			<!-- NEWSWORTHY CONTAINER START-->
			<div class="widget event">
				
				<h3>Newsworthy</h3>
				
				<?php
				$thumb = get_field('thumbnail', $newsworthy['ID']);
				?>
				
				<img class="thumbnail" src="<?php echo $thumb['url'] ?>" />
				
				<h4>Headline: <?php echo $newsworthy['title'] ?> </h4>
				
				<p><?php echo $newsworthy['excerpt'] ?></p>
				
			</div> <!-- NEWSWORTHY CONTAINER END -->
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<div class="container">
		
		<!-- EDITOR'S PICKS CONTAINER START-->
		<div class="widget event">
			
			<h3>Editor's Picks</h3>
			
		</div> <!-- EDITOR'S PICKS CONTAINER END -->
		
	</div>
	
</div>