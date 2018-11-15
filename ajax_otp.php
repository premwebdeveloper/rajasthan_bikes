<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	require_once('new-function.php');
	global $wpdb;
	session_start();
	
	$table_name = $wpdb->prefix."customers";
	$arr = array();
	if(isset($_POST['method']) && $_POST['method'] == 'otpmethod'){
	
	$otp = $_POST['otp'];
    $userid = $_POST['userid'];
	
	$post_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id = '".$userid."'");	
	$otpmsg = "Thank You For Your Registration With Rajasthan Bikes.";
	$onetime = $post_id[0]->otp;
	$mobile = 	$post_id[0]->mobile;
	if($otp==$onetime){
			$arr['status']="1";
			$arr['msg']="your registration successfully";
			$wpdb->update( 
					$table_name, 
					array( 
						'verify' => 1
						), 
					array( 'id' => $userid ));
					sendOtp($mobile,$otpmsg);
			
		} else{
			$arr['msg']="wrong otp";
			}
	}
	
	echo json_encode($arr);
  	
?>
