<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	$arr = array();
	$id = $_POST['id'];
	$table_name = $wpdb->prefix."bookings";
	if(isset($_POST['method']) && $_POST['method'] == 'cancel'){
		
		$wpdb->update( 
					$table_name, 
					array( 
						'order_status' => '2',
						), 
					array( 'id' => $id ));
}
echo json_encode($arr);
?>
