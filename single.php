<?php

	global $data; //fetch options stored in $data

?>
<?php get_header(); ?>
            
            <div id="main_container" class="container">
            
                <!--BEGIN .post-content-->
                <div class="inner_content row">
            		
					<div class="post-content">
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                        <!--BEGIN .hentry -->
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
                                                                                                              
                  			<div class="post-meta">
                                <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                                <span><?php _e('by','framework'); ?></span>
                                <span class="author"><?php the_author_posts_link(); ?> </span>
                                                                     
                            </div><!--cats-->
                            
                            <h2 class="post_title">
                                <?php the_title(); ?>
                            </h2><!--END .post-title -->
                            
                                                            
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">

                                <?php the_content(); ?>
                            
                            </div><!--END .entry-content -->

                            <div class="clear"></div>     
                         
                        
                        	<?php if($data['author_bio'] != 0): ?>
                            <div id="author">
                            
                                <div class="top clearfix">
                                
                                    <h4 class="heading alignleft">
                                        <?php _e('About the Author', 'framework'); ?>
                                    </h4>
                                    
                                    <div class="meta alignright">                                          
                                        <?php 
                                            $twitter = get_the_author_meta('twitter');
                                            if($twitter != ''): 
                                        ?>
                                            <span class="icon twitter"><a href="http://twitter.com/<?php echo $twitter; ?>"><?php _e('Follow on Twitter', 'framework'); ?></a></span>                                                
                                        <?php endif; ?>
                                        
                                        
                                        <?php 											
                                            $facebook = get_the_author_meta('facebook');
                                            if($facebook != ''): 
                                        ?>
                                            <span class="icon facebook"><a href="http://facebook.com/<?php echo $facebook; ?>"><?php _e('Me on Facebook', 'framework'); ?></a></span>
                                        <?php endif; ?>
                                        
                                    </div> <!--meta-->
                                
                                </div> <!--.top-->
                                <div class="clear"></div>                                
                                
                                <div class="image"><?php echo get_avatar( get_the_author_meta('user_email'), '120' ); ?></div>
                                
                                <div class="details">
                                    <h4><?php the_author(); ?></h4>
                                    
                                    <p class="description"><?php the_author_meta("description"); ?></p>
                                    <div class="clear"></div>
                                    <p class="meta">
										<a href="<?php  the_author_meta('user_url') ?>" title="Visit Website">Visit Website</a>
										<span class="author_url"><?php the_author_posts_link(); ?></span>
                                    </p>

                                </div>
                                
                                <div class="clear"></div>
                                
                            </div><!--author-->
                            <?php endif; ?>
                            
							<?php if($data['related_posts'] != 0): ?>
                            <div id="related-posts" class="clearfix cat-container two-columns">
                                
                                <div class="main-title clearfix">
                                     <h2><?php _e('Related Posts', 'framework'); ?></h2>                         
                                 </div>
                
                                <div class="cat-content related-content flexslider">                           
                                                                   
                                    <ul class="slides">
                                    
                                    					
										<?php $i = 1; ?>
                                        <?php $start = 2; ?>
    
                                        <?php if($data['related_posts_type'] == 'tags') : ?>
                                        
                                        <?php
                                        global $post;
                                        $tags = wp_get_post_tags($post->ID);
                                        if ($tags) :
                                            $tag_ids = array();
                                            foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}
                                        
                                            $args=array(
                                                'tag__in' => $tag_ids,
                                                'post__not_in' => array($post->ID),
                                                'showposts'=>$data['related_posts_number'], // Number of related posts that will be shown.
                                                'ignore_sticky_posts'=>1
                                            );
                                            $my_query = new wp_query($args);
                                            $post_count = $my_query->post_count;
                                            if( $my_query->have_posts() ) :
                                                while ($my_query->have_posts()) :
                                                    $my_query->the_post();
                                        ?>                                   
                                        
                                        <?php if(is_multiple($start, 2)) : ?>
                                            <li class="slide">
                                        <?php endif; ?>
                                        
                                             <div class="item clearfix"> 
                                                    
											  <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ 
                                                  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),  array(315,169) );
                                              ?>
                                                    
                                              <div class="image">
                                      
                                                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb[0]; ?>" alt="" height="<?php echo $thumb[2]; ?>" width="<?php echo $thumb[1]; ?>"/></a>
                                              
                                              </div><!--image-->
                                              
                                              <?php endif; ?>
                                              
                                              <div class="details">
                                            
                                                <div class="post-meta">
                                                    <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                                                    <span><?php _e('by','framework'); ?></span>
                                                    <span class="author"><?php the_author_posts_link(); ?> </span>
                                                                                         
                                                </div><!--post-meta-->
                                                
                                                <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                
                                                <div class="excerpt">
                                                
                                                    <?php zd_excerpt('short'); ?>
                                                
                                                </div><!--excerpt-->
                                                
                                                <div class="more_link">
                                                  <a href="<?php the_permalink(); ?>">Read More</a>
                                                </div>
                                            
                                              </div><!--details-->                                      
                                              
                                              </div> <!--END .item -->
                                        
                                        <?php if(is_multiple($i, 2) || $post_count == $i) : ?>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php $i++; ?>
                                        <?php $start++; ?>
                                        
                                        <?php endwhile; endif;// tags loop ?>
                                        
                                        <?php endif; // if have tags ?>
                
                                        <?php else: // if type is categories ?>
                                        
                                        <?php
                                        global $post;
                                        $cats = get_the_category($post->ID);
                                        if ($cats) :
                                            $cat_ids = array();
                                            foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
                                        
                                            $args=array(
                                                'category__in' => $cat_ids,
                                                'post__not_in' => array($post->ID),
                                                'showposts'=>$data['related_posts_number'], // Number of related posts that will be shown.
                                                'ignore_sticky_posts'=>1
                                            );
                                            $my_query = new wp_query($args);
                                            $post_count = $my_query->post_count;
                                        
                                            if( $my_query->have_posts() ) :
                                                while ($my_query->have_posts()) :
                                                    $my_query->the_post(); 
                                        ?>
                                        
    
                                        
                                        
                                        <?php if(is_multiple($start, 2) ) : ?>
                                        <li class="slide">
                                        <?php endif; ?>
                                        
                                         <div class="item clearfix"> 
                                                    
                                          <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                                      
                                          <div class="image">
                                  
                                              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                          
                                          </div><!--image-->
                                          
                                          <?php endif; ?>
                                          
                                          <div class="details">
                                        
                                            <div class="post-meta">
                                                <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                                                <span><?php _e('by','framework'); ?></span>
                                                <span class="author"><?php the_author_posts_link(); ?> </span>
                                                                                     
                                            </div><!--post-meta-->
                                            
                                            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            
                                            <div class="excerpt">
                                            
                                                <?php zd_excerpt('short'); ?>
                                            
                                            </div><!--excerpt-->
                                            
                                            <div class="more_link">
                                              <a href="<?php the_permalink(); ?>">Read More</a>
                                            </div>
                                        
                                          </div><!--details-->                                      
                                          
                                          </div> <!--END .item -->
                                        
                                        <?php if(is_multiple($i, 2) || $post_count == $i) : ?>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php $i++; ?>
                                        <?php $start++; ?>
                                        
                                        <?php endwhile; endif;// tags loop ?>
                                        
                                        <?php endif;// if cats ?>
                                        
                                        <?php endif;// if type is category ?>
                                        
                                        <?php wp_reset_query(); ?>  
                                    
                                    </ul> <!--slides-->
                                    
                                </div><!--.cat-content-->
                            
                            </div><!--END #recent-posts -->
                            <?php endif; ?>
                        
                        </div><!--END .hentry--> 
        
                         <div class="clear"></div> 
                         <?php comments_template('', true); ?>
                                           
                            <?php endwhile; ?>
                                   
                        <?php else : ?>
        
                            <!--BEGIN #post-0-->
                            <div id="post-0" <?php post_class(); ?>>
                            
                                <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
                            
                                <p class="error_msg"><?php _e("Sorry, but you are looking for something that isn't here. Try another search", "framework") ?></p>
                            
                            <!--END #post-0-->
                            </div>
        
                    <?php endif; ?>
                
                </div><!--END .post-content-->
                

				<?php get_sidebar(); ?>
                
                <div class="clear"></div>
					
                </div><!--END .inner-content-->
            
               
            </div><!--END .content-->


<?php get_footer(); ?>