<?php
/*
Template Name: Contact
*/

global $data; //fetch options stored in $data

?>

<?php 
$nameError = '';
$emailError = '';
$commentError = '';
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Veuillez entrer votre nom';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Veuillez entrer une adresse email';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'Veuillez entrer une adresse email valide';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = 'Veuillez entrer un message';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = $data['email'];
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>

<?php get_header(); ?>
			

			<!--BEGIN #main_container-->
			<div id="main_container" class="container">
            
            <div class="inner_content row">
            
            	<!--BEGIN .post-content-->
                <div class="post-content clearfix column">
                			
                <div id="page-top">
                        <h1 id="page-title">
                            <?php 
                            global $post;
                            global $post;
                            if(get_post_meta($post->ID, 'heading_value', true) != ''): 
                                echo get_post_meta($post->ID, 'heading_value', true); 
                            else: 
                                the_title();
                            endif; 
                            ?>
                        </h1>
                 </div> <!--#page_top-->
                
                	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	

                    <?php if($data['embed_map'] != ''): ?>
                    <div class="map_location">
						<?php echo stripslashes($data['embed_map']) ?>                   
                    </div>
                    <?php endif; ?>                
                    
                    <?php if($data['contact_address'] != '' || $data['contact_email'] != '' || $data['contact_phone'] != ''): ?>
                    <div class="contact_details clearfix">
                    	                        
                        <?php if($data['company_name'] != ''): ?>
                        <h2 class="title"><?php echo $data['company_name'] ?></h2>
                        <?php endif; ?>
                        
						
						<?php if($data['contact_address'] != ''): ?>
                        <div class="address">
							<h4 class="title"><?php _e("Adresse","framework") ?></h4>
							<?php echo tz_seperate_message($data['contact_address']) ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($data['contact_email'] != ''): ?>
                        
                        <div class="email">
                            <h4 class="title"><?php _e("Contact","framework") ?></h4>
                            <?php echo tz_seperate_message($data['contact_email']) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                                        
                    <!--BEGIN .entry-content -->
					<div class="entry-content">

					<?php if(isset($emailSent) && $emailSent == true) { ?>
    
                        <div class="thanks">
                            <p><?php _e('Merci, votre message a bien été envoyé', 'framework') ?></p>
                        </div>
    
                    <?php } else { ?>
    
                        <?php the_content(); ?>
            
                        <?php if(isset($hasError) || isset($captchaError)) { ?>
                            <p class="error"><?php _e('Désolé, une erreur est survenue lors de l\'envoi du message', 'framework') ?><p>
                        <?php } ?>
                        
                        <h3><?php echo $data['form_title'] ?></h3>
        
                        <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                            <ul class="contactform clearfix">
                                <li class="name clearfix"><p>
                                <label for="contactName"><small><?php _e('Nom', 'framework') ?><span class="star">*</span></small></label>
                                    <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
                                    <?php if($nameError != '') { ?>
                                        <span class="error"><?php echo $nameError; ?></span> 
                                    <?php } ?>
                                    </p>
                                </li>
                    
                                <li class="email clearfix"><p><label for="email"><small><?php _e('Email', 'framework') ?><span class="star">*</span></small></label>
                                    <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
                                    <?php if($emailError != '') { ?>
                                        <span class="error"><?php echo $emailError; ?></span>
                                    <?php } ?>
                                    </p>
                                </li>
                                
                                <li><div class="clear"></div></li>
                    	
                                <li class="textarea"><p><label for="commentsText"><small><?php _e('Votre message', 'framework') ?><span class="star">*</span></small></label>
                                    <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                    <?php if($commentError != '') { ?>
                                        <span class="error"><?php echo $commentError; ?></span> 
                                    <?php } ?>
                                    </p>
                                </li>
                    
                                <li class="buttons">
                                    <input type="hidden" name="submitted" id="submitted" value="true" />
                                    <button id="submit" type="submit"><?php _e('ENVOYER', 'framework') ?></button>
                                </li>
                            </ul>
                        </form>
                    <?php } ?>
                    </div><!-- .entry-content -->
                    
                    <div class="clear"></div>      
                          
				<!--END .hentry-->  
				</div>

				<?php endwhile; ?>

				<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class(); ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					<!--END .entry-content-->
					</div>
                    
                    <!--END #post-0-->
                    </div>
    
                <?php endif; ?>
                    
                </div><!--END .post-content-->
                
                <?php get_sidebar(); ?>
    
				<div class="clear"></div>
                
                
                </div> <!--.inner_content-->
                
			</div><!--END #main_container-->

<?php get_footer(); ?>