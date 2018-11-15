<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	global $wpdb;

	 if(isset($_POST['method']) && $_POST['method'] == 'bookingupdate')
	 {
		 $id = $_POST['bookid'];
		 $value = $_POST['value'];
		 $tbl 	= 'wp_bookings';
					$set 	= array('order_status' => $value);
					$where 	= array('id' => $id);
					$wpdb->update( $tbl, $set, $where );
					
		 $booked = $wpdb->get_results("SELECT * FROM `wp_bookings` where `id`= '".$id."'");	
		 $useremail = $booked[0]->email;
		 
		//update wp_booking table dateUpto field when user update order status
		
		// $uptodate = $wpdb->get_results("UPDATE `wp_bookings` SET `dateUpto` =  where `id` = '".$id."'");	
		
				//Payment confirmation mail send who enquire 
				 $rajbikemail = 'rad.hemendrarjwt@gmail.com';
				 
				 $subject1 = "Order Status";
				 if($value==0){
					$message1 = "<h4>Hi Your order status is reject</h4>";
				 }
				 if($value==1){
					$message1 .= "<h4>Hi Your order status is order complete</h4>";
					 }
				 if($value==2){
					$message1 .= "<h4>Hi Your order status is pending</h4>";
					 }	 
				 $meesage1 .= "<h4>Thanks RajBikes team</h4>";
				 
				 $header1 = "From:".$useremail." \r\n";
				 $header1 .= "MIME-Version: 1.0\r\n";
				 $header1 .= "Content-type: text/html\r\n";
				 
				 $retval1 = wp_mail($rajbikemail,$subject1,$message1,$header1);
		 }
	
	?>
