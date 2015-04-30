<?php
/**
 * The sidebar containing the main widget area
 *
 *
 */
 
global $issueID;
?>

<div id="secondary" class="widget-area" role="complementary">
	
	<?php if ( $event_id = getLatestEventID() ) : ?>
		<div class="container">
			
			<!-- EVENT CONTAINER START-->
			<div class="widget event">
				
				<h3>Next Event</h3>
				
				<?php
				$thumb = get_field('thumbnail',$event_id);
				$date = date( 'l, F j, Y', strtotime( get_field('date',$event_id) ) );
				$title = get_the_title( $event_id );
				$premalink = get_permalink($event_id);
				?>
				
				<img class="thumbnail" src="<?php echo $thumb['url']?>" />
				
				<h4><?php echo $title ?></h4>
				
				<span class="date"><?php echo $date?></span>
				
				<a class="btn" href="<?php echo $premalink ?>">More Info</a>
				
			</div> <!-- EVENT CONTAINER END -->
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<?php if ( $infographic_id = getInfographicID($issueID) ) : ?>
	
		<?php
		$thumb        = get_field('thumbnails', $infographic_id);
		$image        = get_field('infographic', $infographic_id);
		$issue        = get_field('issue', $infographic_id);
		$issue_number = get_field('issue_number', $issue->ID);
		$summary      = get_field('summary', $infographic_id );
		$title        = get_the_title($infographic_id);
		$premalink    = get_permalink($infographic_id);
		$categories   = get_the_category($infographic_id);
		?>
	
		<div class="container">
			
			<div class="widget infographic">
				
				<!-- INFOGRAPHIC CONTAINER START-->
				<a href="<?php echo $premalink ?>" class="lightbox-open">
					
					<h3>Visually Speaking</h3>
					
					<img class="thumbnail" src="<?php echo $thumb['url']?>" />
					
					<h4><?php echo $title ?></h4>
					
					<p><?php echo $summary ?></p>
					
					<input type="hidden" name="infographic" value="<?php echo $image['url'] ?>" />
					<input type="hidden" name="title" value="<?php echo $title ?>" />
					<input type="hidden" name="issue" value="<?php echo $issue->post_title ?>" />
					<input type="hidden" name="issue_number" value="<?php echo $issue_number ?>" />
					
				</a> <!-- INFOGRAPHIC CONTAINER END -->
				
				<?php if( count($categories) > 0 ) : ?>
					<p class="entry-meta">
						
						<?php foreach($categories as $category) : ?>
							<a href="<?php echo get_category_link($category->term_id) ?>" rel="category tag"><?php echo $category->cat_name ?></a>
						<?php endforeach; ?>
					</p>
				<?php endif; ?>
				
			</div>
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<?php
	$newsworthy = getNewsworthy();
	?>
	
	<?php if ( $newsworthy = getNewsworthy() ) : ?>
		<div class="container">
			
			<!-- NEWSWORTHY CONTAINER START-->
			<div class="widget newsworthy">
				
				<h3>Newsworthy</h3>
				
				<?php
				$thumb = get_field('thumbnail', $newsworthy['ID']);
				$newsworthy_url = get_field('url', $newsworthy['ID']);
				?>
				
				<img class="thumbnail" src="<?php echo $thumb['url'] ?>" />
				
				<h4>Headline: <?php echo $newsworthy['title'] ?> </h4>
				
				<p><?php echo $newsworthy['excerpt'] ?></p>
				
				<a class="read-more" href="<?php echo $newsworthy_url;?>">Read Our Coverage</a>
				
			</div> <!-- NEWSWORTHY CONTAINER END -->
			
		</div>
	<?php endif; ?>
	
	
	
	
	
	<?php if ( have_rows('pick','options') ) : ?>
		<div class="container">
			
			<!-- EDITOR'S PICKS CONTAINER START-->
			<div class="widget editor">
				
				<h3>Editor's Picks</h3>
				
				<ol class="list">
					
					<?php while ( have_rows('pick','options') ) : ?>
					
						<?php the_row() ?>
					
						<li><a href="<?php the_sub_field('link') ?>"><?php the_sub_field('label') ?></a></li>
					
					<?php endwhile; ?>
					
				</ol>
				
			</div> <!-- EDITOR'S PICKS CONTAINER END -->
			
		</div>
		
	<?php endif; ?>
	
</div>