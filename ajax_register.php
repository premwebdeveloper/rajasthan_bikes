<?php
	//print_r($_POST);  die();
	require_once('wp-config.php');
	require_once('wp-load.php');
	require_once('new-function.php');
	global $wpdb;
	$table_name = $wpdb->prefix."customers";
	$arr = array();
	$a = mt_rand(100000,999999);
	
  if(isset($_POST['method']) && $_POST['method'] == 'Register'){
   
    $cname = $_POST['formdata'][0]['value'];
    $pswd = md5($_POST['formdata'][2]['value']);
    $email = $_POST['formdata'][1]['value'];
    $mobile = $_POST['formdata'][3]['value'];
   
    $post_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE (email = '".$email."' OR mobile = '".$mobile."') and verify = 1");
    $num = $wpdb->num_rows;
	
	if($num == 0){
		   $datainsert = array(
							'name' =>  $cname,
                            'email' => $email,
                            'password' => $pswd,
                            'mobile' => $mobile,
							'address' => $_POST['formdata'][4]['value'],
							'otp' => $a,
							'verify' => '0'
							);
    $otpmsg= "Your one time password(OTP) for registration with Rajasthan Bikes is ".$a." which is only valid for 15 minutes.";    
							$wpdb->insert( $table_name, $datainsert);
							$last_insert_id = $wpdb->insert_id;
							if(!empty($last_insert_id))
							{
								sendOtp($mobile,$otpmsg);
								
								
								$arr['status'] = 1;
								$arr['msg'] = "Your account has been created succefully.";
								
								$toMail = $email;
								$fromMail = 'info@rajasthanbikes.com';
								$subject = "Welcome To Rajasthan Bikes-User Account Created";
         
								 $message = '<html xmlns="http://www.w3.org/1999/xhtml>';
								 $message .= '<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rajasthan Bikes</title>
</head>

<body style="line-height: 24px; font-family: Verdana; padding: 0px; margin: 10px;
  font-size: 13px; margin:0px; padding:0px;">
    <div style="margin:0 auto; width:600px;">
        <table style="height: auto; margin-top: 10px;"
               cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" style="background:#fff; border:solid 10px #f3f3f3">
                        <tr>
                            <td style=" background:#ef9a49; padding:10px 15px 20px 15px;; text-align:center">
                                <a href="javascript:;"><img src="';
																			$message .= get_template_directory_uri();
																			$message .= '/images/mail/logo.jpg" alt="RajasthanBikes" /></a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="';
																			$message .= get_template_directory_uri();
																			$message .= '/images/mail/thank-you-banner.png" alt="" /></td>
                        </tr>
                        <tr>
                            <td valign="top" align="left" style="padding:10px 20px 5px 20px;">
                                <p style="margin:0px 0px 8px 0px;">Dear <b>'.$cname.'</b>,</p>
                                <p style="margin:0px 0px 8px 0px;">Greetings of the Day!!!</p>
                                <p style="margin:0px 0px 8px 0px;">We are very pleased to see your interest in our Services.</p>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" align="left" style="padding:10px 20px 5px 20px;">
                                <p style="margin:0px 0px 8px 0px;">Your registration has been successfully completed. Your registration email is <strong>'.$email.'</strong></b>,</p>
                            </td>
                        </tr>

                   

                        <tr>
                            <td valign="top" align="left" style="padding:10px 20px 15px 20px;">
                                <p style="margin:0px 0px 8px 0px;">Thank You.</p>
                                <p style="margin:0px 0px 8px 0px;">Warm Regards</p>
                                <p style="margin:0px 0px 8px 0px;"><strong>Rajasthan Bikes</strong></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>';
$message .= ' </html>';
								 
								 $header = "From:". $fromMail." \r\n";
								 $header .= "MIME-Version: 1.0\r\n";
								 $header .= "Content-type: text/html; charset=UTF-8\r\n";
								 
								 $retval1 = wp_mail($toMail,$subject,$message,$header);
								 $arr['userid']=$last_insert_id;
								 $arr['otpmobile']=$mobile;
							}else
							{
								$arr['status'] = 0;
								$arr['msg'] = "Failed, please try again.";
							}
	} 
	else {
			$arr['msg'] = "Either Email or Mobile Number already exist.";
		 }
 }	
	echo json_encode($arr); 	
?>
