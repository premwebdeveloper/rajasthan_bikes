<?php
//print_r($_POST); die();
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."packages";
	$arr = array();
	$email = $_POST['formdata'][13]['value'];
    if(isset($_POST['method']) && $_POST['method'] == 'Book Now') {
        $datainsert = array(
							'pkgId' => $_POST['formdata'][0]['value'],
							'packageName' => $_POST['formdata'][1]['value'],
							'month' => $_POST['formdata'][2]['value'],
							'days' => $_POST['formdata'][3]['value'],
							'packageAmt' => $_POST['formdata'][4]['value'],
							'txnId' => $_POST['formdata'][7]['value'],
                            'firstName' => $_POST['formdata'][11]['value'],
                            'lastName' => $_POST['formdata'][12]['value'],
                            'email' => $email,
                            'contactNumber' => $_POST['formdata'][14]['value'],
                            'city' => $_POST['formdata'][15]['value'],
                            'state' => $_POST['formdata'][16]['value'],
                            'fromDate' => $_POST['formdata'][17]['value'],
                            'toDate' => $_POST['formdata'][18]['value'],
                            'message' => $_POST['formdata'][19]['value'],
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
					$message .= "Your Tour Package form submitted successfully";
					$message .= "<h4>Thanks</h4>";
	
					$header = "From:".$frommail." \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";
					
					$retval = wp_mail($tomail,$subject,$message,$header);
				}else
				{
					$arr['status'] = 0;
				}
		}		
  	echo json_encode($arr); 	
?>