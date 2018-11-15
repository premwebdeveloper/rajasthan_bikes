<?php
//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."accessories";
	$arr = array();
	/*---------update data------------*/
	if(isset($_POST['method']) && $_POST['method'] == 'update') {
			
		$id = $_POST['formdata'][0]['value'];
		$name = $_POST['formdata'][1]['value'];
		$rentprice = $_POST['formdata'][2]['value'];
			
		$wpdb->update( 
					$table_name, 
					array( 
						'name' => $name, 
						'rentPrice' => $rentprice  
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
							'name' => $_POST['formdata'][1]['value'],
							'rentPrice' =>$_POST['formdata'][2]['value'],
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
