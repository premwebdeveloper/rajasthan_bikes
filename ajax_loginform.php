<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	global $wpdb;
	session_start();
	
	$table_name = $wpdb->prefix."customers";
	$arr = array();
	if(isset($_POST['method']) && $_POST['method'] == 'Login'){
	
	$email = $_POST['formdata'][0]['value'];
    $pwd = md5($_POST['formdata'][1]['value']);
	//$pwd = $_POST['formdata'][1]['value'];
	
	$post_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE (email = '".$email."' AND password = '".$pwd."' and verify=1)");
	if($wpdb->num_rows==0)
	{
		$post_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE (mobile = '".$email."' AND password = '".$pwd."' and verify=1)");
	}
	$num = $wpdb->num_rows;
	$uname = $post_id[0]->name;
	$fnaam = explode(" ",$uname);

		if($num == 1){
			$_SESSION['login_user'] = $post_id[0]->id;
			$_SESSION['username'] = $fnaam[0];
		    $arr['session'] = $_SESSION['login_user'];
		    $arr['status'] = 1;
		    
		    if(!empty($_SESSION['login_user'])){
				$abc = $_SESSION['username']; 
				$fname = $fnaam[0]; 
				$url = home_url().'/logout';
				$url1 = home_url().'/checkout';
				$arr['loginblock'] = $fname."<input type='hidden' name='loginuser' id='loginuser' value='".$_SESSION['login_user']."'>"; 
				
				$arr['cartvalue'] = '<a href='.$url1.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';				  
				}
		} else {
		  $arr['status'] = 0;
		  $arr['msg'] = "Your Login Email or Password is invalid";
		}
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'Forgot'){
	
	$email = $_POST['formdata'][0]['value'];
	
	//generate password randomly
	 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$pass = '';
		for ($i = 0; $i < 5; $i++){
        $pass .= $characters[mt_rand(0, 61)];
		}
	$passwrd = md5($pass);
	$post_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE (email = '".$email."')");
	$num = $wpdb->num_rows;
		
		if($num > 0){
			$wpdb->query( $wpdb->prepare( "UPDATE ".$table_name." SET password = %s WHERE email = %s", $passwrd, $email ) );
			$arr['status'] = 1;					
					
					$tomail = $email;
					$frommail = 'info@rajasthanbikes.com';
					$subject = "Forget Password";
         
					$message = '<html xmlns="http://www.w3.org/1999/xhtml">';
					$message .= '<head>
												<title>Rajasthan Bikes</title>
											</head>
											<body style="line-height: 24px; font-family: Verdana; padding: 0px; margin: 10px;font-size: 13px; margin:0px; padding:0px;">
												<div style="margin:0 auto; width:600px;">
													<table style="height:auto;margin-top:10px;width:100%;" cellpadding="0" cellspacing="0">
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
																		<td valign="top" align="left" style="padding:10px 20px 15px 20px; font-size:16px;">
																			<p style="margin:0px 0px 8px 0px;">Email : '.$email.'</p>
																			<p style="margin:0px 0px 8px 0px;">Password : '.$pass.'</p>
																		</td>
																	</tr>																
																	<tr>
																		<td valign="top" align="left" style="padding:10px 20px 15px 20px; font-size:16px;">
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
												</body>
						</html>';
	
					$header = "From:".$frommail." \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html; charset=UTF-8\r\n";
					
					$retval = wp_mail($email,$subject,$message,$header);
			
		    $arr['msg'] = "Your Password Updated Successfully and Sent to your Email";
		} else {
		  $arr['status'] = 0;
		  $arr['msg'] = "Your Email Address is invalid or not registered";
		}
	}
	echo json_encode($arr);
  	
?>
