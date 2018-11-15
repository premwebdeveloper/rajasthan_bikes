<?php
/*
 *  template name: bike product
 *
 */
get_header(); ?>
<section class="pageBanner">
    <img src="<?php echo get_template_directory_uri(); ?>/images/book-bike-banner.jpg">
        <div class="pageBannerHeading">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Book Your Bike</h2>
                    </div
                </div>
            </div>
        </div>
</section>

<main class="mainContainer">	
    <section class="bookBike">
		
        <div class="container">
			<?php $query = "SELECT MIN($wpdb->postmeta.meta_value) as minprice 
								FROM $wpdb->posts, $wpdb->postmeta
								WHERE $wpdb->postmeta.meta_key = 'price'
								ORDER BY $wpdb->posts.post_date DESC
								";

				   $min = $wpdb->get_results($query, OBJECT);
        		   $price[0] = $min[0]->minprice;
					
				   $querymax = "SELECT MAX($wpdb->postmeta.meta_value) as maxprice 
								FROM $wpdb->posts, $wpdb->postmeta
								WHERE $wpdb->postmeta.meta_key = 'price'
								ORDER BY $wpdb->posts.post_date DESC
								";
				   $max = $wpdb->get_results($querymax, OBJECT);
        		   $price[1] = $max[0]->maxprice; 
        		  
        			?>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <aside class="leftPanel">
                        <section class="bikeCategory">
                            <div class="leftSideColumn">
                                <h3 class="subTitle"><a href="<?php echo esc_url( home_url( ) ); ?>/bikes" >Bike Categories</a> <a href="javascript:;" id="icon" class="iconClick"><i class="fa fa-plus-square" aria-hidden="true"></i></a></h3>
                                <div class="leftSideContent" id="leftSide">
                                    <ul>
        								<?php  foreach(get_categories('parent=0&exclude=15') as $category)	{
											if ($category->term_id != get_option('default_category')) {
        									echo '<li class="parent-item"><a onclick="setSelectedTestPlan('.$category->term_id.');" data-id="'.$category->term_id.'"  class="catname" href="javascript:;">' . $category->name.'</a></li>';
        									} 
        								}
										?>
                                    </ul>
                                </div>
                            </div>
                        </section>
                        <section class="priceRange clear">
                             <div class="leftSideColumn">
                                <h3 class="subTitle">Price Range <a href="javascript:;" id="icon1" class="iconClick"><i class="fa fa-plus-square" aria-hidden="true"></i></a></h3>
                                <div class="leftSideContent" id="leftSide1">
									
									<div id="slider-range"></div>
									 <div class="priceFilter">
										  <label for="amount">Price:</label>
										  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
										</div>

                                </div>
                             </div>
                        </section>
                    </aside>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
					
                    <section class="rightSideBook" id="ajaxres">
						<div class="loadingBlock">
						<div class="loaderOuter"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
					</div>
                    <div class="row">
							<?php
							
							$catid = $_GET['ID'];
							$catarr = array($catid,-1);
							
                            $args = array('cat' => $catarr, 'order' => 'ASC', 'posts_per_page' =>'-1');
                            $the_query = new WP_Query( $args ); 
                            if(have_posts()) {
							 while ( $the_query->have_posts() ) { $the_query->the_post() ?>
							<div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="products__item">
                                <div class="productPic">
                                    <a href="javascript:;" class="products__foto"> 
                                        <?php the_post_thumbnail(); ?> 
                                    </a>
									<?php /*<a href="<?php the_permalink(); ?>" class="bookNowBtn">Book Now</a>
									<a class="addCart" href="javascript:;" onclick="return getSession(<?php echo get_the_ID(); ?>);"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> */ ?>
									
									<!--<a href="javascript:;" class="bookNowBtn" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'booknow');">Book Now</a>-->
									<?PHP /* <a class="addCart" href="javascript:;" onclick="searchPopUp(<?php echo get_the_ID(); ?>,'bookscart');"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to cart</a> */ ?>
									  
                                </div>
                              <h4 class="products__name"><a href="javascript:;"><?php the_title(); ?></a></h4>
                             <div class="products__price_column">
                                <div class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo get_field('bikeprice'); ?></div>
                                <div class="prDay"><?php echo get_field('city_name');?></div>
                              </div>                          
                            </div>
                           </div> 
                           <?php } } ?>
						</div>
                     </section>
                </div>
            </div>
            
        </div>

    </section>
</main>
<?php get_footer(); ?>
<script>
	function setSelectedTestPlan(cid){
			window.location.href = "?ID=" + cid ;
			$('.parent-item').addClass('active');
	}

</script>	

<script>
   $(document).ready(function(){
    
    $("#icon").click(function(){
        $("#leftSide").toggle();
    });
    
    $("#icon").click(function(){
        $("#icon > i").toggleClass("fa-minus-square");
    });
    
    
     $("#icon1").click(function(){
        $("#leftSide1").toggle();
    });
    
    $("#icon1").click(function(){
        $("#icon1 > i").toggleClass("fa-minus-square");
    });
    
});
</script>	
 <script>
	 
	$(function() {
     var mina=<?php echo $price[0]?$price[0]:0; ?>; 
     var maxa=<?php echo $price[1]?$price[1]:5000; ?>; 
    $( "#slider-range" ).slider({
      range: true,
      min: mina,
      max: maxa,
     
      values: [ mina, maxa ],
      
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
      }
	});
		$( "#amount" ).val( "Rs" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - Rs" + $( "#slider-range" ).slider( "values", 1 ) );
  }); 
  
  $( document ).ready(function() {
		 $( "#slider-range" ).mouseup(function() {
				var rng = $('#amount').val();
				var templink = "<?php echo site_url(); ?>";
											$.ajax({
													url: templink+'/ajax_bikerange.php',
													type: 'POST',													
													data:{ajax:true,range:rng},
													success: function(data) {	
														$('#ajaxres').html(data);
													}                                                   
													});
		 });
	});
  </script>
