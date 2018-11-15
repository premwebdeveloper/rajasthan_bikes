<?php 

	require_once('wp-config.php');
	require_once('wp-load.php');
	
	global $wpdb;
	session_start();
	$table_name = $wpdb->prefix."usercart";
	$arr = array();
	$id = $_POST['bid'];
	$url = home_url().'/checkout';
	if(isset($_POST['method'])) {
								
				$results = $wpdb->get_results("delete from wp_usercart where id = '".$id."'");
				
				$numrows = $wpdb->get_results("SELECT id FROM wp_usercart where userid = '".$_SESSION['login_user']."'");
				$_SESSION['cart_total']= count($numrows);
				
				$arr['cartvalue'] = '<a href='.$url.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';
				
				$arr['msg'] = "Record delete succesfully";
			}
  	echo json_encode($arr);
?>
