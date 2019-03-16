<?php if ( have_comments() ) : ?>
      <?php

      $activity = get_the_ID();
      $comments = wp_count_comments( $activity );
      $amountOfComments = $comments->approved;
        
        wp_list_comments( array(
          'style'             => null,
          'short_ping'        => true,
          'callback'          => "my_comments_callback", // custom callback function
          'type'              => 'all',               // show all kind of comments (trashbacks etc.)
          'reply_text'        => '',                  // hide reply text
          
          'per_page'          => 3,                  // display unlimited comments per page
          'reverse_top_level' => true,                // display latest comment first
          'reverse_children'  => null
        ) );
      ?>
  <?php endif; ?>

  <?php
  $comments_args = array(
            // change the title of send button
            'label_submit' => __( 'Posten' ),
            // hide user login
            'logged_in_as' => '',
            // redefine custom textarea field
            'comment_field' => '<textarea id="comment" name="comment" aria-required="false" placeholder="Was liegt an?"></textarea></div>',
            // hide reply
            'title_reply' => '',
            // remove "Text or HTML to be displayed before the set of comment fields"
            'comment_notes_before' => '',
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_after' => '',
            // give the submit button a custom id for styles
            'id_submit' => 'button-std-submit'
    );
    //Check if user is logged in and has the authority to write comments ---> show or hide writing area
    if(is_user_logged_in()){
      $user = wp_get_current_user();
      if(in_array( 'administrator', (array) $user->roles )){
        comment_form($comments_args, $post->ID);
      }else{
        ?> </div> <?php
      }
    }else{
      ?> </div> <?php
    }
  ?>
  <?php 
  
  //Generates the html comments elements
  function my_comments_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>
        <div class="participant">
          <div class="participantPicture">
            <?php echo get_avatar($comment -> user_id); ?>
          </div>
          <div class="participantInfo">
              <p class="participantName"><?php comment_author(); ?></p>
              <p class="postDate"><?php echo(date('l', strtotime(get_comment_date()))); ?>, <?php comment_time(); ?></p>
              <p class="participantEmail"><?php comment_text(); ?></p>
          </div>
          <span class="commentDeleteBtn" data-commentId="<?php echo(get_comment_ID()); ?>"><i class="fa fa-trash-alt" data-commentId="<?php echo(get_comment_ID()); ?>"></i></span>
        </div>
    <?php
}
  ?>
  