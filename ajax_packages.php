<?php
//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."packages";
	$arr = array();
	/*---------update data------------*/
	if(isset($_POST['method']) && $_POST['method'] == 'update') {
			
		$id = $_POST['formdata'][0]['value'];
		$packageName = $_POST['formdata'][1]['value'];
		$grade = $_POST['formdata'][2]['value'];
		$bestTime = $_POST['formdata'][3]['value'];
		$duration = $_POST['formdata'][4]['value'];
		$description = $_POST['formdata'][5]['value'];
		$isNew = $_POST['formdata'][6]['value'];
		$price = $_POST['formdata'][7]['value'];
			
		$wpdb->update( 
					$table_name, 
					array( 
						'packageName' => $packageName, 
						'grade' => $grade,
						'bestTime' => $bestTime,
						'duration' => $duration,
						'description' => $description,
						'isNew' => $isNew,
						'price' => $price
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
							'packagename' => $_POST['formdata'][1]['value'],
							'grade' =>$_POST['formdata'][2]['value'],
							'bestTime' =>$_POST['formdata'][3]['value'],
							'duration' =>$_POST['formdata'][4]['value'],
							'description' =>$_POST['formdata'][5]['value'],
							'isNew' =>$_POST['formdata'][6]['value'],
							'price' =>$_POST['formdata'][7]['value'],
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
