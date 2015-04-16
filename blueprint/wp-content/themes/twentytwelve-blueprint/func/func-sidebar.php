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
	
	if($issue_id === '' or $issue_id === NULL) {
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