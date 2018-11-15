<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	require_once('new-function.php');
	global $wpdb;
if($_POST['method']=='cnfrmbooking'){
	$table_name = $wpdb->prefix."bookings";
	$last_id = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id = '".$_SESSION['current_order']."'");	
	$name =  $last_id[0]->name;
	$bikename =  $last_id[0]->bikeName;
	$usermail =  $last_id[0]->email;
	$contact =  $last_id[0]->contact;
	$datefbike =  $last_id[0]->dateFrom;
	$datetobike =  $last_id[0]->dateUpto;
	$dateUpto = date("Y-m-d H:i",strtotime(date($datetobike)." +1 minutes"));
	$aftrtaxam =  $last_id[0]->totalAmount;
	$otpmsg= "Thanks for Bike Booking at Rajasthan Bike. Your Booking ID:".$_SESSION['current_order']." for ".$bikename." Your Total Amount is Rs.".$aftrtaxam.". Please check full details on E-mail.";
	//$datacall=sendOtp($contact,$otpmsg);
//	$toMail = $usermail;
	//$fromMail = 'info@rajasthanbikes.com';
	$subject = "Thanks For Bike Booking";        
	$message = '<html xmlns="http://www.w3.org/1999/xhtml>';
	$message .= '<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rajasthan Bikes</title>
	</head>
		<body style="line-height: 24px; font-family: Verdana; padding: 0px; margin: 10px;
		font-size: 13px; margin:0px; padding:0px;">
  <div style="margin: 0 auto; width: 600px;">
    <table style="height: auto; margin-top: 10px;" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table style="background: #fff; border: solid 10px #f3f3f3;" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="background: #ef9a49; padding: 10px 15px 20px 15px; ; text-align: center;">
                                <a href="javascript:;"><img src="';
																			$message .= get_template_directory_uri();
																			$message .= '/images/mail/logo.jpg" alt="RajasthanBikes" /></a></td>
                            </tr>
                            <tr>
                                <td><img src="';
																			$message .= get_template_directory_uri();
																			$message .= '/images/mail/thank-you-banner.png" alt="" /></td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 10px 20px 10px;" align="center" valign="top">
                                    <h3 style="font-size: 18px; font-weight: 600; margin: 0px; padding-bottom: 15px;">'.$name.'</h3>
                                    <p style="font-size: 16px; margin: 0px;">Thanks&nbsp;For Booking</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 20px 15px 20px; font-size: 16px;" align="left" valign="top">
                                    <p style="margin: 0px 0px 8px 0px;">Details of the Booking&nbsp;are as follows :</p>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Bike Name</td>
                                                <td>:</td>
                                                <td>'.$bikename.'</td>
                                            </tr>
                                            <tr>
                                                <td>DateFrom</td>
                                                <td>:</td>
                                                <td>'.$datefbike.'</td>
                                            </tr>
                                            <tr>
                                                <td>DateUpto</td>
                                                <td>:</td>
                                                <td>'.$dateUpto.'</td>
                                            </tr>
                                            <tr>
                                                <td>TotalAmount</td>
                                                <td>:</td>
                                                <td>'.$aftrtaxam.'</td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <p>Please carry your DL/UID card which was used for booking</p>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 20px 15px 20px; font-size: 16px;" align="left" valign="top">
                                    <p style="margin: 0px 0px 8px 0px;">Thank You.</p>
                                    <p style="margin: 0px 0px 8px 0px;"><strong>Rajasthan Bikes</strong></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>';
$message .= ' </html>';

								 
								 $header = "From:". $fromMail." \r\n";
								 $header .= "MIME-Version: 1.0\r\n";
								 $header .= "Content-type: text/html; charset=UTF-8\r\n";
								 
								// $retval1 = wp_mail($toMail,$subject,$message,$header);
					$arr['status']='1';
		
			 }
			
	
	echo json_encode($arr);
  	
?>
