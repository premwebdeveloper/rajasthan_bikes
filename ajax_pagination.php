<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	global  $wpdb;
	$inquirytable = $wpdb->prefix."enquiries";
	$page = $_POST['inqdata'];	
	
	$limit=10;
	$start=($page-1)*$limit;
	
	$InquiryRow = $wpdb->get_results("SELECT * FROM ".$inquirytable." LIMIT 10 OFFSET ".$start);
	
	$arr = array();
	$form = array();
	$arr['message'] = '';
	$arr['status'] = 1;
	
	for($a=0;$a<$limit;$a++){
	
	$form = $InquiryRow[$a];
	$id_cust = $form->{'id_astro_inquiry'};
	
	$arr['list'] .=
									'<tr>
									<td>'.$form->{"id_astro_inquiry"}.'</td>
									<td>'.$form->{"full_name"}.'</td>
									<td>'.$form->{"email_add"}.'</td>
									<td>'.$form->{"gender"}.'</td>
									<td>'.$form->{"dob"}.'</td>
									<td>'.$form->{"item_number"}.'</td>
									<td>'.$form->{"item_name"}.'</td>';
									if(!empty($id_cust)) { 
	$arr['list'] .=					'<td><a class="inq_submit" onclick="showinfo('.$id_cust.');" >View</a></td></tr>';
								}
							}		
	echo json_encode($arr);

?>
