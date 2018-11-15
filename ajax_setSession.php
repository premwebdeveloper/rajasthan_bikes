<?php
require_once('wp-config.php');
require_once('wp-load.php');
session_start();
$arr = array();
$check = '';
$url = home_url().'/checkout';	
	if(isset($_POST['cartitem'])){	
	$_SESSION['cart_total'] = $_POST['cartitem']-1;
	$arr['cartvalue'] = '<a href='.$url.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';
	}
	echo json_encode($arr);
?>
