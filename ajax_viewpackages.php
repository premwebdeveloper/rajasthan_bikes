<?php 
 
        require_once('wp-config.php');
	
		require_once('wp-load.php');
	
		global $wpdb;
		$inquirytable = $wpdb->prefix."packages";
 
 
		if(isset($_REQUEST['pkgId'])){
	
						$InquiryRow = $wpdb->get_results("SELECT * FROM ".$inquirytable." WHERE id = ".$_REQUEST['pkgId']);
						$arr['status'] = 1;

						$arr['message'] = '<table>
										<tr><th scope="row">packageName</th><td>'.$InquiryRow[0]->packageName.'</td></tr>
										<tr><th scope="row">month</th><td>'.$InquiryRow[0]->month.'</td></tr>
										<tr><th scope="row">days</th><td>'.$InquiryRow[0]->days.'</td></tr>	
										<tr><th scope="row">packageAmount</th><td>'.$InquiryRow[0]->packageAmt.'</td></tr>	
										<tr><th scope="row">firstName</th><td>'.$InquiryRow[0]->firstName.'</td></tr>	
										<tr><th scope="row">lastName</th><td>'.$InquiryRow[0]->lastName.'</td></tr>	
										<tr><th scope="row">email</th><td>'.$InquiryRow[0]->email.'</td></tr>
										<tr><th scope="row">contactNumber</th><td>'.$InquiryRow[0]->contactNumber.'</td></tr>	
										<tr><th scope="row">city</th><td>'.$InquiryRow[0]->city.'</td></tr>	
										<tr><th scope="row">state</th><td>'.$InquiryRow[0]->state.'</td></tr>
										<tr><th scope="row">fromDate</th><td>'.$InquiryRow[0]->fromDate.'</td></tr>	
										<tr><th scope="row">toDate</th><td>'.$InquiryRow[0]->toDate.'</td></tr>
										<tr><th scope="row">message</th><td>'.$InquiryRow[0]->message.'</td></tr>
										</table>';
	
	echo json_encode($arr);
	
		}
?>
