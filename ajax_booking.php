<?php
    require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$inquirytable = $wpdb->prefix."bookings";
	

	if(isset($_REQUEST['bookId'])){
		$InquiryRow = $wpdb->get_results("SELECT * FROM ".$inquirytable." WHERE id = ".$_REQUEST['bookId']);
		$date	  =	date($InquiryRow[0]->dateUpto);   		        
		$dateUpto = date("Y-m-d H:i",strtotime(date($date)." +1 minutes")); 
		$arr['status'] = 1;
		$arr['message'] = 	'<table>
							<tr><th scope="row">bikeName</th><td>'.$InquiryRow[0]->bikeName.'</td></tr>
							<tr><th scope="row">bikeRent</th><td>'.$InquiryRow[0]->bikeRent.'</td></tr>
							<tr><th scope="row">Service Charge</th><td>'.$InquiryRow[0]->servicecharge.'</td></tr>
							<tr><th scope="row">name</th><td>'.$InquiryRow[0]->name.'</td></tr>	
							<tr><th scope="row">email</th><td>'.$InquiryRow[0]->email.'</td></tr>	
							<tr><th scope="row">contact</th><td>'.$InquiryRow[0]->contact.'</td></tr>	
							<tr><th scope="row">PickUpCity</th><td>'.$InquiryRow[0]->pickCity.'</td></tr>	
							<tr><th scope="row">state</th><td>'.$InquiryRow[0]->state.'</td></tr>
							<tr><th scope="row">DateFrom</th><td>'.$InquiryRow[0]->dateFrom.'</td></tr>	
							<tr><th scope="row">DateUpto</th><td>'.$dateUpto.'</td></tr>	
							
							<tr><th scope="row">Remark</th><td>'.$InquiryRow[0]->remark.'</td></tr>
							<tr><th scope="row">PaymentStatus</th><td>'.$InquiryRow[0]->payment_status.'</td></tr>
							<tr><th scope="row">TotalAmount</th><td>'.$InquiryRow[0]->totalAmount.'</td></tr>
							</table>';	
	echo json_encode($arr);	
	}
?>
