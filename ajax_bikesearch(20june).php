<?php
	require_once('wp-config.php');
	require_once('wp-load.php');
	global $wpdb;	
	
	session_start();
	$arr = array();
	$check = '';
	$url = home_url().'/checkout';
	
	if(isset($_POST['method']) && $_POST['method']=='bookscart' ){
		
		$totalbikes = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key = 'total_bikes' AND post_id = '".$_POST['bikeid']."' "); 
		$allbikes = $totalbikes[0]->meta_value;
			
		$booked = $wpdb->get_results("SELECT bikeId,dateFrom FROM wp_bookings WHERE ((dateFrom >= '".$_POST['from']."' and dateFrom <= '".$_POST['upto']."') or (dateUpto >= '".$_POST['from']."' and dateUpto <= '".$_POST['upto']."')) AND bikeId = '".$_POST['bikeid']."' ");
		$bookedbikes = count($booked);
		$available = $allbikes-$bookedbikes;
		/*
		if(isset($_POST['bikeid'])){
			
					if(!empty($_SESSION['allbikes']) && isset($_SESSION['allbikes']))
					{
						$_SESSION['allbikes'] .=','.$_POST['bikeid'];
						
						$_SESSION['cart_total'] = count(explode(',',$_SESSION['allbikes']));
						//echo $_SESSION['cart_total'];
						$arr['cartvalue'] = '<a href='.$url.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';
					}
					else{
						$_SESSION['allbikes'] = $_POST['bikeid'];
						$_SESSION['cart_total'] = '1'; 
						$arr['cartvalue'] = '<a href='.$url.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';
					}
				}
		 */		
		if(isset($_POST['from']) && isset($_POST['upto'])){
				if(isset($_SESSION['fromDate']) && isset($_SESSION['uptoDate']))
					{ 
						$_SESSION['fromDate'] .=','.$_POST['from'];
						$_SESSION['uptoDate'] .=','.$_POST['upto'];
					} else { 
						$_SESSION['fromDate'] = $_POST['from'];
						$_SESSION['uptoDate'] = $_POST['upto'];
					}	
				}		
		
		if($available==0)
		{ $arr['status'] = 3; } 
		else 
			{ 
			$arr['status'] = 4;	
			$addtocart = $wpdb->get_results("INSERT into wp_usercart (userid,bikeid,fromdate,todate) VALUES ('".$_SESSION['login_user']."','".$_POST['bikeid']."','".$_POST['from']."','".$_POST['upto']."') ");
			
			$numrows = $wpdb->get_results("SELECT id FROM wp_usercart where userid = '".$_SESSION['login_user']."'");
			$_SESSION['cart_total']= count($numrows);
			$arr['cartvalue'] = '<a href='.$url.'><i class="fa fa-shopping-cart"></i>'.$_SESSION['cart_total'].'</a>';
			} 	
		echo json_encode($arr);
	}
		
	if(isset($_POST['method']) && $_POST['method']=='booknow' ){
		
		//echo "SELECT meta_value FROM wp_postmeta WHERE meta_key = 'total_bikes' AND post_id = '".$_POST['bikeid']."' ";
		$totalbikes = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key = 'total_bikes' AND post_id = '".$_POST['bikeid']."' "); 
		$allbikes = $totalbikes[0]->meta_value;
		
		//echo "SELECT bikeId,dateFrom FROM wp_bookings WHERE ((dateFrom >= '".$_POST['from']."' and dateFrom <= '".$_POST['upto']."') or (dateUpto >= '".$_POST['from']."' and dateUpto <= '".$_POST['upto']."')) AND bikeId = '".$_POST['bikeid']."' ";
		$booked = $wpdb->get_results("SELECT bikeId,dateFrom FROM wp_bookings WHERE ((dateFrom >= '".$_POST['from']."' and dateFrom <= '".$_POST['upto']."') or (dateUpto >= '".$_POST['from']."' and dateUpto <= '".$_POST['upto']."')) AND bikeId = '".$_POST['bikeid']."' ");
		
		$bookedbikes = count($booked);
		$available = $allbikes-$bookedbikes;		 
		
			if(isset($available))
			{
				$_SESSION['bookfrom'] = $_POST['from'];
				$_SESSION['bookupto'] = $_POST['upto'];
				$arr['status'] = 2;
				$arr['bid'] = $_POST['bikeid'];
			} else {
				$arr['status'] = 0;
			}
		echo json_encode($arr);
	}	
	if(isset($_POST['method']) && $_POST['method']=='minhour' ){
			$cat = $wpdb->get_results("SELECT DISTINCT ID, post_title, post_name, guid, post_date, post_content
				FROM wp_posts AS p
				INNER JOIN wp_term_relationships AS tr ON (
				p.ID = tr.object_id
				)
				INNER JOIN wp_term_taxonomy AS tt ON (
				tr.term_taxonomy_id = tt.term_taxonomy_id
				AND taxonomy = 'category' AND tt.term_id
				IN ( 10 )
				)
				ORDER BY id DESC");
				
				$arr = array();
				for($i=0;$i<count($cat);$i++){
				$arr[] = $cat[$i]->ID;
				}
				 $timeinterval = 0;
				 $bookfrom = $_POST['from'];
				 $bookupto = $_POST['upto'];
				 $from = strtotime($bookfrom);
				 $upto = strtotime($bookupto);
					 
				$result=in_array($_POST['bikeid'] ,$arr);
				if($result !=''){
						$timeinterval = $upto - $from;
						if($timeinterval < 36000 )
						{
						$arr['status'] = 0;
						$arr['msg'] = "Please select minimum 10 hrs";
						} 										
				} else {
						$timeinterval = $upto - $from;
						if($timeinterval < 18000 )
						{
						$arr['status'] = 0;
						$arr['msg'] = "Please select minimum 5 hrs";
						}	
				}				
				echo json_encode($arr);	
	}
	/*else { 
			//$filterDate = $wpdb->get_results("SELECT bikeId FROM wp_bookings WHERE dateFrom between '".$_POST['from']."' and '".$_POST['upto']."' or dateUpto between '".$_GET['from']."' and	'".$_GET['upto']."'");
			
			$filterDate = $wpdb->get_results("SELECT bikeId FROM wp_bookings WHERE ((dateFrom between '".$_POST['from']."' AND '".$_POST['upto']."') AND (dateUpto between '".$_POST['from']."' AND '".$_POST['upto']."')) "); 
			
			$allbikes = array();	
			for($i=0;$i<count($filterDate);$i++){
			$allbikes[$i] .= $filterDate[$i]->bikeId;
			}
			
			$bikelist = $wpdb->get_results("
												SELECT DISTINCT wp_posts.ID FROM wp_posts
												LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id)
												LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
												WHERE wp_posts.post_status = 'publish'
												AND wp_posts.post_type = 'post'
												AND wp_term_relationships.term_taxonomy_id");	
			$res = array();
			for($i=0;$i<count($bikelist);$i++){
			$res[$i] = $bikelist[$i]->ID;	
			}
				
			$result = array_diff($res,$allbikes);
			if(isset($result)){
			$arr['status'] = 1;
			$arr['bid'] = $result;	
			} else {
			$arr['status'] = 0;
			$arr['bid'] = '';	
			}	
	}*/
?>
