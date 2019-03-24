<?php 
get_header();
?>
<div class="page-banner">
  <div class="page-banner__bg-image_ref" style="background-image: url(<?php echo get_theme_file_uri("/images/dummy.png") ?>);">
  </div>
  <div class="page-banner__content container t-center c-white">
    <div class ="userpageBannerContent">
        <div class ="userpageBannerIconWrapper">
            <div class ="userpageBannerAvatarDiv"><?php echo get_avatar(get_current_user_id(), 80) ?></div>
            <a href="<?php echo wp_logout_url( home_url() ); ?>"><p class="userpageBannerLogoutBtn">Logout</p></a>
        </div>
        <div class="userpageBannerGreetingWrapper">
            <?php $participant = wp_get_current_user(); ?>
            <h1 class="userpageBannerGreeting">Hallo <?php echo $participant->user_login ?></h1>
            <!--<p class="userpageBannerGreetingAddition">Lorem ipsum dolor sit amet, 
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
                et dolore magna aliquyam</p>-->
        </div>
    </div>
  </div> 
</div>

<div class="timetable_area">
    <h3 class="singlePageHeadlines">Mein Wochenkalender</h3>
    <div class="timetable">
        <?php createTimetable(); ?>
    </div>
</div>

<div class="userpageNewsAndFollowArea">
    <div class="userpageNewsArea">
        <p class="userpageNewsAreaHeadline">News</p>
        <div class="userpageNewsAreaContentArea">

            <?php 
            $post__in = array();
            $argsFollower = array(
                'post_type'		=> 'follower',
                'numberposts'	=> -1,
                'meta_query'	=> array(
                    'relation'		=> 'OR',
                    array(
                        'key'		=> 'follower_id',
                        'value'		=> get_current_user_id(),
                        'compare'	=> '='
                        ),
                    )
                );
                
                $homepageReferate = new WP_Query($argsFollower);
                while($homepageReferate->have_posts()){
                    $homepageReferate->the_post();
                    array_push($post__in, get_field("followed_activity_id", get_the_ID()));
                    wp_reset_postdata();
                }
                    $argsComments = array('orderby' => array('comment_date') ,'number' => 3, "order" => "DESC", 'post__in' => $post__in);
                    $comments = get_comments( $argsComments );
                   
                    foreach($comments as $comment){
                        $activityId = $comment->comment_post_ID;
                        $authorId = $comment->user_id; 
                        ?>
                        <div class="participant">
                            <div class="participantPicture">
                                <?php echo get_avatar($authorId); ?>
                            </div>
                            <div class="participantInfo">
                                <p class="participantName"><?php comment_author(); ?> in <?php echo get_the_title($activityId);?></p>
                                <p class="postDate"><?php echo(date('l', strtotime(get_comment_date()))); ?>, <?php comment_time(); ?></p>
                                <p class="participantEmail"><?php comment_text(); ?></p>
                            </div>
                        </div> <?php
                    }
            ?>
        </div>
    </div>
    <div class="userpageFollowerArea">
        <p class="userpageFollowerAreaHeadline">Gefolgte Refferate</p>
        <div class="userpageFollowerAreaContentArea">
            <?php getFollowedActivities(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>