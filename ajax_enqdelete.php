<?php
//print_r($_POST); 
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$table_name = $wpdb->prefix."enquiries";
	$arr = array();
	
	/*---------delete data------------*/
		 if(isset($_POST['method']) && $_POST['method'] == 'delete') {
			$id = array('id' => $_POST['id']);
			
			$wpdb->delete($table_name,$id);
			$arr['showmessage'] = "Record Deleted Successfully.";		
		}
echo json_encode($arr);
?>
