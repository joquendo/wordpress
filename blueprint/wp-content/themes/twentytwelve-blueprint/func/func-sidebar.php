<?php

//get the latest event id
function getLatestEventID () {

	global $wpdb;
	
	//get todays date
	$today = date( 'Ymd', time() );
	
	//query results from the database
	$sql = "SELECT a.ID,
	               (SELECT b.meta_value FROM wp_postmeta b WHERE b.post_id=a.ID AND b.meta_key='date') AS `date`
	        FROM wp_posts a
	        WHERE a.post_type='event' AND a.post_status = 'publish'
	        HAVING `date` >= $today
	        ORDER BY `date` ASC
	        LIMIT 1";
	$results = $wpdb->get_results($sql);
	
	//if there are results
	if( count($results) > 0 ) {
	
		//return the id
		return $results[0]->ID; 
		
	//else return false
	} else {
		return false;
	}
}





//get the infographic for the current issue
function getInfographicID ($issue_id = '') {
	
	global $wpdb;

	//if on homepage and there is no issue set
	if( ($issue_id === '' or $issue_id === NULL) AND $_SERVER['REQUEST_URI'] === '/' ) {
		//get latest issue
		$sql = "SELECT *
		        FROM wp_posts a
		        WHERE a.post_type='issue' AND a.post_status = 'publish'
		        ORDER BY a.post_date DESC
		        LIMIT 1";
		$result_issue = $wpdb->get_results($sql);	
		$issue_id = $result_issue[0]->ID;
	}
	
	//get issue infographic
	$sql = "SELECT a.ID,
				   (SELECT b.meta_value FROM wp_postmeta b WHERE b.post_id=a.ID AND b.meta_key='issue') AS `issue`
	        FROM wp_posts a
	        WHERE a.post_type='infographic' AND a.post_status = 'publish'
	        HAVING `issue`='$issue_id'
	        LIMIT 1";
	$result_infographic = $wpdb->get_results($sql);
	
	
	//if there are results
	if( count($result_infographic) > 0 ) {
		
		//return the id
		return $result_infographic[0]->ID;
	
	//else return false
	} else {
		return false;
	}

}





//get the latest newsworthy item
function getNewsworthy () {
	
	global $wpdb;
	
	$ret = array();
	
	//get latest newsworthy article
	$sql = "SELECT *
	        FROM wp_posts a
	        WHERE a.post_type='newsworthy' AND a.post_status = 'publish'
	        ORDER BY a.post_date DESC
	        LIMIT 1";
	$result = $wpdb->get_results($sql);
	
	if( count($result) > 0 ) {
		
		//return newsworthy values
		$ret['ID']        = $result[0]->ID;
		$ret['title']     = $result[0]->post_title;
		$ret['excerpt']   = $result[0]->post_excerpt;
		
		return $ret;
	
	//else return false
	} else {
		return false;
	}
}





//get all the archive for the infographic
function getInfographic ($currentID) {
	
	global $wpdb;

	//get the archives
	$sql = "SELECT *
	        FROM wp_posts a
	        WHERE a.post_type='infographic' AND a.post_status = 'publish' AND a.ID <> '$currentID'
	        ORDER BY a.post_date DESC";
	$result = $wpdb->get_results($sql);
	
	if ( count($result) > 0 ) {
		
		return $result;
		
	} else {
		return false;
	}
	
	echo $sql;
}





//add lightbox to image tag
function get_image_tag_function ( $html, $id, $alt, $title, $align, $size ) {
	
	return '<span class="lightbox-img-container '. $align .'">'.$html.'</span>';
}

add_filter('get_image_tag', 'get_image_tag_function', 10, 6);

//add lightbox to captions
function img_caption_function ($empty, $attr, $content) {
	
	global $wpdb;
	
	//get the post id
	$tmp = explode( '_',$attr['id'] );
	$id = $tmp[1];
	
	//get the credits
	$sql = "SELECT * FROM wp_posts a WHERE a.ID=$id";
	$result = $wpdb->get_results($sql);
	
	//format credit
	$credit = '';
	if( count($result) > 0 ) {
		$credit = ' <br/>Photo Credit : ' . $result[0]->post_content;
	}
	
	$ret  = '<div id="'.$attr['id'].'" style="width: '.$attr['width'].'px" class="wp-caption '.$attr['align'].'">';
	$ret .=   '<span class="lightbox-img-container">' . $content . '</span>';
	$ret .= '  <p class="wp-caption-text">' . $attr['caption'] . $credit . '</p>';
	$ret .= '</div>';
	
	return $ret;
}

add_filter( 'img_caption_shortcode', 'img_caption_function', 10, 3);