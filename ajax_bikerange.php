<?php

	require_once('wp-config.php');
	require_once('wp-load.php');

	global $wpdb;
	$table = $wpdb->prefix."postmeta";
	if(isset($_POST['range'])){
	$range = explode('-',$_POST['range']);
	$min = str_replace('Rs','',$range[0]);
	$max = str_replace('Rs','',$range[1]);
	
	$query = $wpdb->get_results("SELECT post_id FROM ".$table." WHERE (meta_value BETWEEN ".$min." AND ".$max.") AND meta_key='bikeprice' ");
	
	$all = '';
	//print_r(count($query)); die();						
	for($i=0;$i<=count($query);$i++){
	$all .= $query[$i]->post_id;
	$all .= ',';
	}
	
	$allstr = substr($all,'0','-2');
	$allarr = explode(',',$allstr);

	$aaa = '';
	
	
	$args = array('post__in' => $allarr, 'order' => 'ASC','posts_per_page' => '-1');
    $the_query = new WP_Query( $args ); 
    
	 while ( $the_query->have_posts() ) { $the_query->the_post(); $aaa .=''; ?>
		
	<div class="col-md-4 col-sm-6 col-xs-6">
							
                            <div class="products__item">
                                <div class="productPic">
                                    <a href="javascript:;" class="products__foto"> 
                                        <?php the_post_thumbnail(); 
                                        $avlb = get_field('total_bikes'); ?> 
                                    </a>
									<!--<a href="<?php //echo get_permalink(); ?>" class="bookNowBtn">Book Now</a>
									<a class="addCart" href="javascript:;" onclick="return getSession(<?php echo get_the_ID(); ?>);"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
									<a href="javascript:;" class="bookNowBtn" <?php if($avlb==0){ ?>onclick="">Already Booked</a>
										<!--<a class="addCart" href="javascript:;" onclick=""><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> -->
								<?php	}else{  ?> 
                                <a href="javascript:;" class="bookNowBtn" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'jaipur','booknow');">Book Now</a>
                                <?php } ?>
                                 <!--<a class="addCart" href="javascript:;" onclick="searchAddToCart(<?php echo get_the_ID(); ?>,'bookscart');"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
                                </div>
                              <h4 class="products__name"><a href="javascript:;"><?php the_title(); ?></a></h4>
                              <!--<div class="addressLoacation">
                                <span><?php echo get_field('location'); ?></span>
                              </div>-->
                              <div class="products__price_column">
                                <div class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('bikeprice'); ?>/Day</div>
                                <div class="price pull-right"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('hoursprice'); ?>/Hr</div>
                              </div>                          
                            </div>
                           </div> 
     <?php } }elseif(isset($_POST['hour'])){
	$range = explode('-',$_POST['hour']);
	$hrmin = str_replace('Rs','',$range[0]);
	$hrmax = str_replace('Rs','',$range[1]);

	//$range = explode('-',$_POST['hour']);
	//$min = str_replace('Rs','',$range[0]);
	//$max = str_replace('Rs','',$range[1]);
	
	$query = $wpdb->get_results("SELECT post_id FROM ".$table." WHERE (meta_value BETWEEN ".$hrmin." AND ".$hrmax.") AND meta_key='hoursprice' ");

	$all = '';
	//print_r(count($query)); die();						
	for($i=0;$i<=count($query);$i++){
	$all .= $query[$i]->post_id;
	$all .= ',';
	}
	
	$allstr = substr($all,'0','-2');
	$allarr = explode(',',$allstr);

	$aaa = '';
	
	
	$args = array('post__in' => $allarr, 'order' => 'ASC', 'posts_per_page' => '-1');
    $the_query = new WP_Query( $args ); 
    
	 while ( $the_query->have_posts() ) { $the_query->the_post(); $aaa .=''; ?>
		
	<div class="col-md-4 col-sm-6 col-xs-6">
							
                            <div class="products__item">
                                <div class="productPic">
                                    <a href="javascript:;" class="products__foto"> 
                                        <?php the_post_thumbnail(); 
                                        $avlb = get_field('total_bikes'); ?> 
                                    </a>
									<!--<a href="<?php //echo get_permalink(); ?>" class="bookNowBtn">Book Now</a>
									<a class="addCart" href="javascript:;" onclick="return getSession(<?php echo get_the_ID(); ?>);"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
									<a href="javascript:;" class="bookNowBtn" <?php if($avlb==0){ ?>onclick="">Already Booked</a>
										<!--<a class="addCart" href="javascript:;" onclick=""><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> -->
								<?php	}else{  ?> 
                                <a href="javascript:;" class="bookNowBtn" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'jaipur','booknow');">Book Now</a>
                                <?php } ?>
                                 <!--<a class="addCart" href="javascript:;" onclick="searchAddToCart(<?php echo get_the_ID(); ?>,'bookscart');"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
                                </div>
                              <h4 class="products__name"><a href="javascript:;"><?php the_title(); ?></a></h4>
                              <!--<div class="addressLoacation">
                                <span><?php echo get_field('location'); ?></span>
                              </div>-->
                              <div class="products__price_column">
                                <div class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('bikeprice'); ?>/Day</div>
                                <div class="price pull-right"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('hoursprice'); ?>/Hr</div>
                              </div>                          
                            </div>
                           </div> 
     <?php } }elseif(isset($_POST['hourrs'])){
		 	//$range = explode('-',$_POST['hourrs']);
			$hrmin = $_POST['minimum'];
			$hrmax = $_POST['maximum'];
		 
	//$range = explode('-',$_POST['hour']);
	//$min = str_replace('Rs','',$range[0]);
	//$max = str_replace('Rs','',$range[1]);
	
	$query = $wpdb->get_results("SELECT post_id FROM ".$table." WHERE (meta_value BETWEEN ".$hrmin." AND ".$hrmax.") AND meta_key='hoursprice' ");

	$all = '';
	//print_r(count($query)); die();						
	for($i=0;$i<=count($query);$i++){
	$all .= $query[$i]->post_id;
	$all .= ',';
	}
	
	$allstr = substr($all,'0','-2');
	$allarr = explode(',',$allstr);

	$aaa = '';
	
	
	$args = array('post__in' => $allarr, 'order' => 'ASC','posts_per_page' => '-1');
    $the_query = new WP_Query( $args ); 
    
	 while ( $the_query->have_posts() ) { $the_query->the_post(); $aaa .=''; ?>
		
	<div class="col-md-4 col-sm-6 col-xs-6">
							
                            <div class="products__item">
                                <div class="productPic">
                                    <a href="javascript:;" class="products__foto"> 
                                        <?php the_post_thumbnail(); 
                                        $avlb = get_field('total_bikes'); ?> 
                                    </a>
									<!--<a href="<?php //echo get_permalink(); ?>" class="bookNowBtn">Book Now</a>
									<a class="addCart" href="javascript:;" onclick="return getSession(<?php echo get_the_ID(); ?>);"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
									<a href="javascript:;" class="bookNowBtn" <?php if($avlb==0){ ?>onclick="">Already Booked</a>
										<!--<a class="addCart" href="javascript:;" onclick=""><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> -->
								<?php	}else{  ?> 
                                <a href="javascript:;" class="bookNowBtn" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'jaipur','booknow');">Book Now</a>
                                <?php } ?>
                                 <!--<a class="addCart" href="javascript:;" onclick="searchAddToCart(<?php echo get_the_ID(); ?>,'bookscart');"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
                                </div>
                              <h4 class="products__name"><a href="javascript:;"><?php the_title(); ?></a></h4>
                              <!--<div class="addressLoacation">
                                <span><?php echo get_field('location'); ?></span>
                              </div>-->
                              <div class="products__price_column">
                                <div class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('bikeprice'); ?>/Day</div>
                                <div class="price pull-right"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('hoursprice'); ?>/Hr</div>
                              </div>                          
                            </div>
                           </div> 
     <?php } }elseif(isset($_POST['dayss'])){
		 	//$range = explode('-',$_POST['hourrs']);
			$hrmin = $_POST['minimum'];
			$hrmax = $_POST['maximum'];
		 
	//$range = explode('-',$_POST['hour']);
	//$min = str_replace('Rs','',$range[0]);
	//$max = str_replace('Rs','',$range[1]);
	
	$query = $wpdb->get_results("SELECT post_id FROM ".$table." WHERE (meta_value BETWEEN ".$hrmin." AND ".$hrmax.") AND meta_key='hoursprice' ");

	$all = '';
	//print_r(count($query)); die();						
	for($i=0;$i<=count($query);$i++){
	$all .= $query[$i]->post_id;
	$all .= ',';
	}
	
	$allstr = substr($all,'0','-2');
	$allarr = explode(',',$allstr);

	$aaa = '';
	
	
	$args = array('post__in' => $allarr, 'order' => 'ASC','posts_per_page' => '-1');
    $the_query = new WP_Query( $args ); 
    
	 while ( $the_query->have_posts() ) { $the_query->the_post(); $aaa .=''; ?>
		
	<div class="col-md-4 col-sm-6 col-xs-6">
							
                            <div class="products__item">
                                <div class="productPic">
                                    <a href="javascript:;" class="products__foto"> 
                                        <?php the_post_thumbnail(); 
                                        $avlb = get_field('total_bikes');
                                        ?> 
                                    </a>
									<!--<a href="<?php //echo get_permalink(); ?>" class="bookNowBtn">Book Now</a>
									<a class="addCart" href="javascript:;" onclick="return getSession(<?php echo get_the_ID(); ?>);"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
									<a href="javascript:;" class="bookNowBtn" <?php if($avlb==0){ ?>onclick="">Already Booked</a>
										<!--<a class="addCart" href="javascript:;" onclick=""><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> -->
								<?php	}else{  ?> 
                                <a href="javascript:;" class="bookNowBtn" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'jaipur','booknow');">Book Now</a>
                                <?php } ?>
                                 <!--<a class="addCart" href="javascript:;" onclick="searchAddToCart(<?php echo get_the_ID(); ?>,'bookscart');"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a>-->
                                </div>
                              <h4 class="products__name"><a href="javascript:;"><?php the_title(); ?></a></h4>
                              <!--<div class="addressLoacation">
                                <span><?php echo get_field('location'); ?></span>
                              </div>-->
                              <div class="products__price_column">
                                <div class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('bikeprice'); ?>/Day</div>
                                <div class="price pull-right"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('hoursprice'); ?>/Hr</div>
                              </div>                          
                            </div>
                           </div> 
     <?php } }
	
	echo $aaa;
	

?>


