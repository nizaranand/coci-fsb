<?php
	global $data; //fetch options stored in $data
?>

    <!-- BEGIN #footer-container -->
    <div id="footer" class="container">

            <div class="footer_inner row clearfix">
            
            <!-- BEGIN .widget-section -->
                <div class="grid_four neutral">
                	
                    <?php /* Footer Widget one */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer One' ) ) ?>
                    
                
                </div><!-- END .grid_four -->   
                
                <!-- BEGIN .widget-section -->
                <div class="grid_four">
                
                	<?php /* Footer Widget two */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Two' ) ) ?>
                    
                  
                </div><!-- END .grid_four --> 

                <!-- BEGIN .widget-section -->
                <div class="grid_four">
                
                	<?php /* Footer Widget three */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Three' ) ) ?>
                    
                
                </div><!-- END .grid_four -->   
                
                <!-- BEGIN .widget-section -->
                <div class="grid_four">

                	<?php /* Footer Widget four */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Four' ) ) ?>
                    
                
                </div><!-- END .grid_four -->   
            
                <div class="clear"></div>
                               
            </div><!--Footer-inner-->
        </div><!-- end .footer -->
	
		
        <div id="footer_bottom" class="container">
                
                <div class="footer_inner attribution clearfix row">
                
                    <p class="copyright"><?php echo date( 'Y' ); ?><span><?php echo $data['copyright'] ?></span></p>
                	                   
                      <div id="footer-nav">
                          <?php if ( has_nav_menu( 'footer-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                          <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
                          <?php } ?>
                              
                      </div>
 
                </div> <!--attribution--> 
                
                <div class="top_scroll"><a href="#top"><?php _e('&uarr;', 'framework'); ?></a></div>
                
          </div> <!--Footer_bottom-->   
        
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	
    
    
    	</div> <!--.inner_warp-->
    
    </div> <!--.wrap .container	-->

</body><!--END body-->

</html><!--END html-->