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
$content       	= get_the_content();
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
			<div id="in-topics">
				<p class="entry-meta"><span class="title">In topics:</span>
				<?php 
					$categories = get_the_category();
					$separator = ' ';
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" rel="category tag">'.$category->cat_name.'</a>'.$separator;
						}
						$topics_list = trim($output, $separator); //REUSE THIS VAR TO DISPLAY CATEGORIES
						echo $topics_list;
					} 
				?>
				</p>
				
				<?php if( has_tag() ) : ?>
				<p class="entry-meta tags"><span class="title">Tagged:</span><?php the_tags( '', ', ' ); ?></p>
				<?php endif;?>
			</div>
		<?php endif; ?>
		
		
		
		
		
		
		<?php if( $archives ) : ?>

		
			<!--ARCHIVE OF INFOGRAPHIC-->
			<div class="infographic-archive clearfix">
				
				<h3>Also Visually Speaking</h3>
				
				<?php $count = 0; ?>
				<?php foreach($archives as $key=>$archive ) : ?>
				
					<?php
					$archive_issue  = get_field('issue', $archive->ID);
					$archiveImage   = get_field('sidebar_image', $archive->ID);
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