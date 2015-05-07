<div id="taxonomy">
	<?php if( has_category() ): ?>
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
	<?php endif; ?>
	
	<?php if( has_tag() ) : ?>
	<p class="entry-meta tags"><span class="title">Tagged:</span><?php the_tags( '', ', ' ); ?></p>
	<?php endif;?>
</div>