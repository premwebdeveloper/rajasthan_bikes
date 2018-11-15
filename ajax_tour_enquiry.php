<?php
	//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
    include 'new-function.php';
	global $wpdb;
	$table_name = $wpdb->prefix."enquiries";
	$name = $_POST['enqdata'][0]['value'];
	$email = $_POST['enqdata'][1]['value'];
	$phone = $_POST['enqdata'][2]['value'];
	$remark = $_POST['enqdata'][7]['value'];
	$arr = array();
	$otpmsg="Thank you for your Enquiry. We have received your e-mail and will respond to you shortly. Regards,Rajasthan Bikes Team.";
$msges = sendSMSCustomer($phone,$otpmsg);
	
	//$expdata = explode("|",$msg);
	
	/*---------update data------------*/
	if(isset($_POST['method']) && $_POST['method'] == 'Submit') {
		
		$datainsert = array(
							'name' => $name,
							'email' =>$email,
							'phoneno' =>$phone,
							'packageName' =>$_POST['enqdata'][3]['value'],
							'seatsRequired' =>$_POST['enqdata'][4]['value'],
							'dateFrom' =>$_POST['enqdata'][5]['value'],
							'dateUpto' =>$_POST['enqdata'][6]['value'],
							'remarks' =>$remark,
				);
				$wpdb->insert( $table_name, $datainsert);
				$last_insert_id = $wpdb->insert_id;
				
				$getdirectory = get_template_directory_uri();
				
				if(!empty($last_insert_id))
				{
					$arr['status'] = 1;
					$arr['msg'] = "your enquiry form has been submitted successfully we will contact you soon";
					$tomail = $email;
					$frommail = 'info@rajasthanbikes.com';
					$subject = "Thanks For Enquiry Of Tour packages";
         
					$message = '<html xmlns="http://www.w3.org/1999/xhtml">';
					$message .= '<head>
												<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
												<title>Rajasthan Bikes</title>
											</head>

											<body style="line-height: 24px; font-family: Verdana; padding: 0px; margin: 10px;
											  font-size: 16px; margin:0px; padding:0px;">
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
																			<p style="margin:0px 0px 8px 0px;">Your Tour Package Query For : '.$_POST['enqdata'][3]['value'].'</p>
																			
																		</td>
																	</tr>

																	<tr>
																		<td valign="top" align="left" colspan="2" style="padding:10px 20px 15px 20px; font-size:16px;">
																			<table style="width: 100%;" cellpadding="0" cellspacing="0">
																				<tr>
																					<td style="width: 200px;">
																						Name
																					</td>
																					<td>'.$name.'</td>
																				</tr>
																				<tr>
																					<td>
																						Email :
																					</td>
																					<td>
																						'.$email.'
																					</td>
																				</tr>
																				<tr>
																					<td>
																						Mobile
																					</td>
																					<td>
																						'.$phone.'
																					</td>
																				</tr>																		
																				
																			</table>
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
															<!--<td width="50%" style="padding:10px;">
																<span dir="ltr">@USERNAME</span>
																<p> thanks for contact</p>
															</td>
															<td width="50%" style="padding:10px;" align="right"><a href="javascript:;"><img src="images/logo_mod-a.png" alt="" /></a></td>-->
														</tr>
													</table>
												</div>
											</body>
											</html>';
	
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
