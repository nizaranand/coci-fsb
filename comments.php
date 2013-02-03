<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
	echo 'This post is password protected. Enter the password to view comments.';
	return;
}
?>

<?php if ( have_comments() ) : ?>

<div id="comments" class="clearfix">

    <h3 id="comments"><?php comments_number('Aucun Commentaire', 'Un Commentaire', '% Commentaires' );?></h3>
     
    <ol class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=60&callback=theme_comment'); ?>
	</ol>

	<?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
    
        <h3 id="pings"><?php _e('Trackbacks for this post', 'framework') ?></h3>
        
        <ol class="pinglist">
        	<?php wp_list_comments('type=pings'); ?>
        </ol>
        
    <?php endif; ?>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
    
</div>
    
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ($post->comment_status == 'open') : ?>
        <p style="margin-top:20px;" >Il n'y a aucun commentaire à cet article. <strong>Soyez le premier !</strong></p>
    <? else : ?>
        <p style="margin-top:20px;">&nbsp;</p>
    <?php endif; ?>

<? endif; 

/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$fields =  array(
	'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Nom', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '
	<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
); 

$defaults = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'title_reply'          => 'Commenter',
	'title_reply_to'       => __( 'Laisser un commentaire pour %s' ),
	'cancel_reply_link'    => __( 'Annuler réponse' ),
	'label_submit'         => __( 'Laisser un commentaire' ),
	'comment_notes_after'  => ''
);

comment_form($defaults);

?>