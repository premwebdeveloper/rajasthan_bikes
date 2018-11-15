<?php
	//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
		
	$tblbooking = $wpdb->prefix."booking";
	$InquiryRow = $wpdb->get_results("SELECT requiredAccessories FROM ".$tblbooking );
	print_r($InquiryRow);
	
	$table_name = $wpdb->prefix."accessories";
	$InquiryRow = $wpdb->get_results("SELECT rentPrice FROM ".$table_name." WHERE(requiredAccessories = IN (2, 4, 5))" );

	$arr = array();
	
  	echo json_encode($arr);
  	
?>
