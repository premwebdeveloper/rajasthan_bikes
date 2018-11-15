<?php
	require_once('wp-config.php');
	require_once('wp-load.php');	
	global $wpdb;
	$table_name = $wpdb->prefix."package_images";
	$arr = array();
	/*---------update data------------*/
	if(isset($_POST['method']) && $_POST['method'] == 'update') {
			//echo $_POST;die();
		$id = $_POST['formdata'][0]['value'];
		$packageid = $_POST['formdata'][1]['value'];
		$imagename = $_POST['formdata'][2]['value'];
		$ismain = $_POST['formdata'][3]['value'];
		$imageorder = $_POST['formdata'][4]['value'];
			
		$wpdb->update( 
					$table_name, 
					array( 
						'packageId' => $packageid, 
						'imageName' => $imagename,
						'isMain' => $ismain,
						'imageorder' => $imageorder
						), 
					array( 'id' => $id ));
		$arr['showmessage'] = "Record Updated Successfully.";
		}
		/*---------delete data------------*/
		else if(isset($_POST['method']) && $_POST['method'] == 'delete') { //echo "jhdfkjshd";die();
			$id = array('id' => $_POST['id']);
			
			$wpdb->delete($table_name,$id);
			$arr['showmessage'] = "Record Deleted Successfully.";		
		}
		/*---------add data------------*/
		else {
				$datainsert = array(
							'packageID' =>$_POST['formdata'][1]['value'],
							'imageName' =>$_POST['formdata'][2]['value'],
                            'isMain' =>$_POST['formdata'][3]['value'],
                            'imageOrder' =>$_POST['formdata'][4]['value'],
				);
				$wpdb->insert( $table_name, $datainsert);
				$last_insert_id = $wpdb->insert_id;
				//echo $last_insert_id; die();
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
