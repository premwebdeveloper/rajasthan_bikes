<?php
	
	require_once('wp-config.php');
	require_once('wp-load.php');
	global $wpdb;	
	
	$bikeId = $_REQUEST['bikeid'];
	
	$qry = "SELECT meta_value as totalBikes FROM `wp_postmeta` where meta_key='total_bikes' and post_id='".$bikeId."'";
	$result = $wpdb->get_results($qry);
	$totalBikes = $result[0]->totalBikes;	
		
	$result = $wpdb->get_results("SELECT dateFrom, dateUpto FROM `wp_bookings` where bikeid='".$bikeId."' and (dateFrom > now() or dateUpto > now()) AND `payment_status` = 'success'");	
	
	$arrBookingCount = array();	
	/*
	$arrBookingCount['2016-09-02'] = '1'
	$arrBookingCount['2016-09-22'] = '2'
	*/	
	
	$arrNoBookingDates = array();
	/*
	$arrNoBookingDates = array('2016-09-02', '2016-09-22')
	*/
	
	foreach($result as $value)
	{
		$dateFrom = $value->dateFrom;
		$dateUpto = $value->dateUpto;
		
		while($dateFrom <= $dateUpto)
		{			
			$dtCurrent = date('Y-m-d',strtotime($dateFrom));
			$dateFrom = date('Y-m-d',strtotime($dateFrom . "+1 days"));
			
			if(isset($arrBookingCount[$dtCurrent]))
			{
				$arrBookingCount[$dtCurrent] = $arrBookingCount[$dtCurrent] + 1;
			}
			else
			{
				$arrBookingCount[$dtCurrent] = 1;
			}
			
			if($arrBookingCount[$dtCurrent] >= $totalBikes && !in_array($dtCurrent, $arrNoBookingDates))
			{
				array_push($arrNoBookingDates, $dtCurrent);
			}
		}		
	}
	
	sort($arrNoBookingDates);
	
	echo json_encode('{"Dates":"'.implode(",", $arrNoBookingDates).'"}');	
	
?>
