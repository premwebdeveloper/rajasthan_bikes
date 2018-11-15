<?php
$arr = '';
$method = $_POST['method'];
$method = explode('_',$method);
$bid  = $_POST['bid'];
session_start();
switch($method[0])
	{
	case 'increment':
	{
		$arr['incr'] = $_POST['incval1']+1;
		$_SESSION['incr_'.$bid] = $arr['incr'];
		$count = $_POST['incval2']*$arr['incr'];
		$arr['totalPrice'] = $_POST['bRent'] * $count;
		$_SESSION['totalPrice_'.$bid] = $arr['totalPrice'];
		break;
	}
	case 'decrement':
	{
		$arr['incr'] = $_POST['decval1']-1;
		$_SESSION['incr_'.$bid] = $arr['incr'];
		$count = $_POST['decval2']*$arr['incr'];
		$arr['totalPrice'] = $_POST['bRent'] * $count;
		$_SESSION['totalPrice_'.$bid] = $arr['totalPrice'];
		break;
	}
	case 'increment1':
	{
		$arr['incr1'] = $_POST['incval1']+1;
		$_SESSION['incr1_'.$bid] = $arr['incr1'];
		$count = $_POST['incval2']*$arr['incr1'];
		$arr['totalPrice'] = $_POST['bRent'] * $count;
		$_SESSION['totalPrice_'.$bid] = $arr['totalPrice'];
		break;
	}
	case 'decrement1':
	{
		$arr['incr1'] = $_POST['decval1']-1;
		$_SESSION['incr1_'.$bid] = $arr['incr1'];
		$count = $_POST['decval2']*$arr['incr1'];
		$arr['totalPrice'] = $_POST['bRent'] * $count;
		$_SESSION['totalPrice_'.$bid] = $arr['totalPrice'];
		break;
	}	
}
	
	$_SESSION['basePrice_'.$bid] = $_POST['bRent'];
	echo json_encode($arr);
?>
