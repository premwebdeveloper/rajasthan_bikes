<?php
//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."coupan_code";
	$arr = array();

	/*---------update data------------*/
	if(isset($_POST['method']) && $_POST['method'] == 'update') {
		
	    $id = $_POST['formdata'][0]['value'];	
		$coupanname = $_POST['formdata'][1]['value'];
		$coupancode = $_POST['formdata'][2]['value'];
		$discount = $_POST['formdata'][3]['value'];
		$maxdis = $_POST['formdata'][4]['value'];
		$startdate = $_POST['formdata'][5]['value'];
		$enddate = $_POST['formdata'][6]['value'];
		$user = $_POST['formdata'][7]['value'];
		$active = $_POST['formdata'][8]['value'];
		$termcn = $_POST['formdata'][9]['value'];
		$wpdb->update( 
					$table_name, 
					array( 
						'coupanName' => $coupanname,
						'coupanCode' => $coupancode,
						'discount' => $discount,
						'maxDiscount' => $maxdis,
						'startDate' => $startdate,
						'endDate' => $enddate,
						'perUserallow' => $user,
						'active' => $active,
						'termndtn' => $termcn,
						), 
					array( 'id' => $id ));
		$arr['showmessage'] = "Record Updated Successfully.";
		}
		/*---------delete data------------*/
		else if(isset($_POST['method']) && $_POST['method'] == 'delete') {
			$id = array('id' => $_POST['id']);
			
			$wpdb->delete($table_name,$id);
			$arr['showmessage'] = "Record Deleted Successfully.";		
		}
		/*---------add data------------*/
		else {
				$datainsert = array(
							'coupanName' => $_POST['formdata'][1]['value'],
							'coupanCode' => $_POST['formdata'][2]['value'],
							'discount' => $_POST['formdata'][3]['value'],
							'maxDiscount' => $_POST['formdata'][4]['value'],
							'startDate' => $_POST['formdata'][5]['value'],
							'endDate' => $_POST['formdata'][6]['value'],
							'perUserallow' => $_POST['formdata'][7]['value'],
							'active' => $_POST['formdata'][8]['value'],
							'termndtn' => $_POST['formdata'][9]['value'],
							
				);
				$wpdb->insert( $table_name, $datainsert);
				$last_insert_id = $wpdb->insert_id;
				if(!empty($last_insert_id))
				{
					$arr['status'] = 1;
					$arr['showmessage'] = "Your form has been submitted.";
				}else
				{
					$arr['status'] = 0;
					$arr['showmessage'] = "Failed, please try again.";
				}
		}	
		
  	echo json_encode($arr);
  	
?>
