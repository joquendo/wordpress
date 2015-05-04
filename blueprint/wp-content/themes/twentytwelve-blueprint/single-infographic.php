<?php
get_header(); 

//retrieve meta values for the page
wp_reset_query();
$infographic_id = get_the_ID();
$title          = get_the_title();
$full_image		= get_field('full_image', $infographic_id);
$issue          = get_field('issue', $infographic_id);
$issue_date     = get_field('issue_date', $issue->ID);
$issue_number   = get_field('issue_number', $issue->ID);
$pdf            = get_field('pdf_download', $infographic_id);
$content        = get_the_content();
$tags           = wp_get_post_terms($infographic_id);
$categories     = get_the_category($infographic_id);

$archives = getInfographic($infographic_id);
?>

<div class="infographic-wrapper">
	
	<div class="content">
		
		<h3>Visually Speaking</h3>
		
		<h1 class="entry-title"><?php echo $title ?></h1>
		
		<img class="header" src="<?php echo $full_image['url'] ?>" />
		
		<div class="icon-container">
			<span class="icon-expand lightbox-open">
				<input type="hidden" name="infographic" value="<?php echo $full_image['url'] ?>" />
				<input type="hidden" name="title" value="<?php echo $title ?>" />
				<input type="hidden" name="issue" value="<?php echo $issue->post_title ?>" />
				<input type="hidden" name="issue_number" value="<?php echo $issue_number; ?>" />
			</span>
			
			<?php if( $pdf ) : ?>
				<span class="icon-download">
					<a href="<?php echo $pdf['url'] ?>">&nbsp;</a>
				</span>
			<?php endif; ?>
		</div>
		
		
		<p class="tag-issue">
			<span class="issue-name"><?php echo $issue->post_title ?></span>. <?php echo $issue_date ?>, ISSUE #<?php echo $issue_number ?>
		</p>
		
		<p class="description"><?php echo $content ?></p>
		
		
		<?php if(count($categories) > 0 and count($tags) > 0) : ?>
		
			<div class="taxonomy clearfix">
				
				<div class="col-1">
					
					<?php if(count($categories) > 0) : ?>
						In Topics:
						<p class="entry-meta">
							<?php foreach($categories as $key=>$category) : ?>
								<a href="<?php echo get_category_link($category->term_id) ?>" rel="category tag"><?php echo $category->name ?></a>
							<?php endforeach; ?>
						</p>
					<?php endif; ?>
				</div>
				
				<div class="col-2">
					
					<?php if(count($tags) > 0) : ?>
						Tags: 
						<span class="tags">
						
							<?php
							//print tags
							foreach ($tags as $key=>$tag) {
								echo $tag->name;
								if( (count($tags)-1) > $key)
									echo ', ';
							}
							?>
						</span>
					<?php endif; ?>
				</div>
			
			</div>
		<?php endif; ?>
		
		
		
		
		
		
		<?php if( $archives ) : ?>
		
			<!--ARCHIVE OF INFOGRAPHIC-->
			<div class="infographic-archive clearfix">
				
				<h3>Also Visually Speaking</h3>
				
				<?php $count = 0; ?>
				<?php foreach($archives as $key=>$archive ) : ?>
				
					<?php
					$archiveImage   = get_field('sidebar_image', $archive->ID);
					$archive_issue  = get_field('issue', $archive->ID);
					$archive_date   = get_field('issue_date', $archive_issue->ID);
					$archive_number = get_field('issue_number', $archive_issue->ID);
					$permalink      = get_permalink($archive->ID);
					?>
					
					<a href="<?php echo $permalink ?>" class="item <?php echo ( ($count%3) === 2 )? 'last':'' ?>">

					<?php if ( ! empty( $archiveImage ) ) : ?>

						<img src="<?php echo $archiveImage['url'] ?>" />

					<?php else : ?>

						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fpo-thumbnail.png"/>

					<?php endif; ?>

						<div class="title">
							<?php echo $archive->post_title; ?>
						</div>
						<div class="date">
							<?php echo $archive_date ?>, Issue #<?php echo $archive_number ?>
						</div>
					</a>
					
					<?php $count++; ?>
				
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		
	</div>

</div>





<?php get_footer(); ?>