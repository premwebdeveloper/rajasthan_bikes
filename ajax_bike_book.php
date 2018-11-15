<?php
	//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."bookings";
	$email = $_POST['enqdata'][3]['value'];
	$arr = array();
	$access = '';
	$cnt = count($_POST['enqdata']);
	$pos = 1;
	for($i=0; $i<=$cnt; $i++){
	 if($_POST['enqdata'][$i]['name'] == 'accessories[]')
		 {
			 $access .=  $_POST['enqdata'][$i]['value'].','; 
			 $pos++;
		 }
	}
	$access = rtrim($access, ",");
	
	$pic = 11 + $pos;
	$drop = $pic + 1;
	$msg = $drop + 1;
	$bikeid = $msg + 1;
	
		$bikerent = $_POST['enqdata'][1]['value'];
		$picdate = $_POST['enqdata'][9]['value'];
		$dropdate = $_POST['enqdata'][10]['value'];
		
		$start = strtotime($picdate);
		$end = strtotime($dropdate);
		
		if($end > $start)
		{
			$diff = $end - $start;
			$day = ceil($diff/86400);
			$bikerent = $bikerent*$day;
		}
		
		$datainsert = array(
							'bikeName' => $_POST['enqdata'][0]['value'],
							'bikeId' => $_POST['enqdata'][$bikeid]['value'],
							'bikeRent' =>$bikerent,
							'name' =>$_POST['enqdata'][2]['value'],
							'email' =>$email,
							'contact' =>$_POST['enqdata'][4]['value'],
							'state' =>$_POST['enqdata'][5]['value'],
							'city' =>$_POST['enqdata'][6]['value'],
							'bikePreference1' =>$_POST['enqdata'][7]['value'],
							'bikePreference2' =>$_POST['enqdata'][8]['value'],
							'dateFrom' => $picdate,
							'dateUpto' => $dropdate,
							'pickOrDropRequired' =>$_POST['enqdata'][11]['value'],
							'requiredAccessories' =>$access,
							'pickupCity' =>$_POST['enqdata'][$pic]['value'],
							'dropCity' =>$_POST['enqdata'][$drop]['value'],
							'remark' =>$_POST['enqdata'][$msg]['value'],
				);
				$wpdb->insert( $table_name, $datainsert);
				$last_insert_id = $wpdb->insert_id;
				if(!empty($last_insert_id))
				{
					$arr['status'] = 1;					
					$arr['id'] = $last_insert_id;
					$tomail = $email;
					$frommail = 'rad.hemendrarjwt@gmail.com';
					$subject = "Book Bike";
         
					$message = "<h4>Hi</h4>";
					$message .= "<p>I have enquiry reqarding</p>";
					$message .= "ktrrty";
					$message .= "All mendatory details are as follows";
					$message .= "<h4>Thanks</h4>";
	
					$header = "From:".$frommail." \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";
					
					$retval = wp_mail($tomail,$subject,$message,$header);
				}else
				{
					$arr['status'] = 0;			  
				}
	
  	echo json_encode($arr);
  	
?>
