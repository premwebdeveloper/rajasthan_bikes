<?php 
	require_once('wp-config.php');
	require_once('wp-load.php');
	session_start();
	
	global $wpdb;
	$table_name = $wpdb->prefix."cart";
	
	if(isset($_POST['method']) && $_POST['method'] == 'delete' ){
		$id = array('id' => $_POST['pid']);
		$wpdb->delete($table_name,$id);
	} 
	else {
	$allid = explode(',',$_POST['sid']);
	foreach($allid as $pid){
		
		$querystr = "
					SELECT $wpdb->postmeta.meta_value 
					FROM $wpdb->posts, $wpdb->postmeta
					WHERE $wpdb->postmeta.post_id = ".$pid." 
					AND $wpdb->postmeta.meta_key = 'price'
					ORDER BY $wpdb->posts.post_date DESC
				 ";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		
		$uid = $_POST['uid'];
		$days = (!empty($_SESSION['incr_'.$pid])) ? $_SESSION['incr_'.$pid] : '1';
		$qnty = (!empty($_SESSION['incr1_'.$pid])) ? $_SESSION['incr1_'.$pid] : '1';
		$totalRent = (!empty($_SESSION['totalPrice_'.$pid])) ? $_SESSION['totalPrice_'.$pid] : $pageposts[0]->meta_value;
		$baseRent = (!empty($_SESSION['basePrice_'.$pid])) ? $_SESSION['basePrice_'.$pid] : $pageposts[0]->meta_value;
		
	    $datainsert = array(
		'userID' =>  $uid,
		'productID' => $pid,
		'days' => $days,
		'baseRent' => $baseRent,
		'qunty' => $qnty,
		'totalRent' => $totalRent,
		); 
		$wpdb->insert( $table_name, $datainsert);
		}
	}
?>
