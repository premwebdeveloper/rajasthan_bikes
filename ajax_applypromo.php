<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	session_start();
	global $wpdb;
	$arr = array();
	$lastId = $_POST['idlast'];

	if(isset($_POST['method'])){
		
		$promoval = $_POST['value'];
		$totalamount = $_POST['amount'];
		$lastId = $_POST['idlast'];
		$totaltax = $_POST['tax'];
		
		$table_code = $wpdb->prefix."coupan_code";
		$table_order = $wpdb->prefix."coupan_order";
		$currentDate= date('d/m/Y');
		$getpromocode = $wpdb->get_results("SELECT * FROM ".$table_code." WHERE coupanCode = '".$promoval."'");

		$wpdb->get_results("SELECT * FROM ".$table_code." WHERE coupanCode = '".$promoval."' and startDate<='".$currentDate."' and endDate >='".$currentDate."'");

		$checkDatePromoCode = $wpdb->num_rows;

		$coupanid = $getpromocode[0]->id;
		$peruser = $getpromocode[0]->perUserallow;
		$code = $getpromocode[0]->coupanCode;
		$percent = $getpromocode[0]->discount;
		$mindiscount = $getpromocode[0]->minDiscount;
		$maxdiscount = $getpromocode[0]->maxDiscount;
		$strdate = $getpromocode[0]->startDate;
		$enddate = $getpromocode[0]->endDate;
		$end = strtotime($enddate);
		$getuser = $wpdb->get_results("SELECT * FROM ".$table_order." WHERE userId = '".$_SESSION['login_user']."'");
		$allrow = $wpdb->num_rows;
		$allrow;
	
		//for maintaing apply coupon code till only coupan expiry date

		$table_book = $wpdb->prefix."bookings";
		$getdate = $wpdb->get_results("SELECT * FROM ".$table_book." WHERE id = '".$lastId."'");
		$dateupto = $getdate[0]->dateUpto;
		$dateup = strtotime($dateupto);
		$datefrom = $getdate[0]->dateFrom;
		$datefr = strtotime($datefrom);
		
		$getuser = $wpdb->get_results("SELECT * FROM ".$table_order." WHERE userId = '".$_SESSION['login_user']."'");
		//print_r($getuser);
		$user = $getuser[0]->orderId;
		

		if($user!=$lastId){	
		if($dateup<=$end){ 
			if(!empty($promoval)){							
				if($promoval == $code){			
					if($checkDatePromoCode>=0){
						if($peruser>$allrow){											
							$newprice = $percent*$totalamount/100;
							if($maxdiscount<$newprice){ $discounamount=$maxdiscount; } else { $discounamount = $newprice; }	
							$afterdiscount = $totalamount-$discounamount;
							$serviceCharge =  (0 * $afterdiscount)/100;	
							$afterdistotalamnt = $serviceCharge+$afterdiscount;
							$table_name = $wpdb->prefix."bookings";
							$wpdb->update( 
							$table_name, 
							array( 
								'servicecharge'=>$serviceCharge,
								'totalAmount' => $afterdistotalamnt,
								'aftrdiscountrent' => $afterdiscount,
								), 
							array( 'id' => $lastId ));
							$arr['servicetax']= $serviceCharge;		
							$arr['discountamount']= $discounamount;		
							$arr['aftrdiscountamount']= $afterdiscount;
							$arr['afterdistotalamnt']= $afterdistotalamnt;
							$arr['msg']="Coupon Apply Successfully";
							$arr['status'] = '1';	
							$table_order = $wpdb->prefix."coupan_order";
							$datainsert = array(
									'userId' => $_SESSION['login_user'],
									'orderId' => $lastId,
									'coupanId' => $coupanid,
									'type' => 'bike',
									);
							$wpdb->insert( $table_order, $datainsert);
							
								
						}else{ 
							$arr['msg']="Code has been used"; 
							$arr['status'] = '2';
							}
						}else{$arr['msg']= "Code is expired"; 
							 $arr['status'] = '3'; 
							 }
								
						}else{
							$arr['msg']="Promo code is invalid";
							$arr['status'] = '4';
							}
						}else{
							$arr['msg']="Enter promo code"; 
							$arr['status'] = '0';
							}
						}else{
							$arr['msg']="Only apply booking before Coupon Expiry Date";
							$arr['status'] = '5';
							} 
					}else{
					echo "plz match";
					}
				}
		echo json_encode($arr);
		?>
