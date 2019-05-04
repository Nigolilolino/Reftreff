<?php 
get_header();
?>
<?php 
    $followedActivities = array();
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
        
        $userActivities = new WP_Query($argsFollower);
        while($userActivities->have_posts()){
            $userActivities->the_post();
            array_push($followedActivities, get_field("followed_activity_id", get_the_ID()));
            wp_reset_postdata();
        }
?>
<div id="overlayAvatarUpload" class="overlay"></div>
<div id="avatarUpload" class="avatarUpload">
    <?php echo do_shortcode("[avatar_upload]"); ?>
</div>

<div class="wrapperUserpage">
    <div class="page-banner">
    <?php 
    if(count($followedActivities) == 0){
        $randomeActivityHeaderUrl = get_theme_file_uri("/images/dummy.png");
    }else{
        $randomeNumber = array_rand ($followedActivities, 1);
        $randomeActivity = $followedActivities[$randomeNumber];
        $randomeActivityHeaderUrl = get_field("header_referate", $randomeActivity);
    }

    ?>
    <div class="page-banner__bg-image_ref" style="background-image: url(<?php echo $randomeActivityHeaderUrl?>);">
    </div>
    <div class="page-banner__content container t-center c-white">
        <div class ="userpageBannerContent">
            <div class ="userpageBannerIconWrapper">
                <div  class ="userpageBannerAvatarDiv"><?php echo get_avatar(get_current_user_id(), 80) ?>
                    <div id="uploadBtn" class="uploadBtn" data-active="false">upload</div>
                </div>
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
            <p class="userpageNewsAreaHeadline singlePageHeadlines">News</p>
            <div class="userpageNewsAreaContentArea">

                <?php
                    if(count($followedActivities) == 0){
                        ?> <p>Momentan sind keine News vorhanden.</p> <?php
                    }else{
                        $argsComments = array('orderby' => array('comment_date') ,'number' => 3, "order" => "DESC", 'post__in' => $followedActivities);
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
                    }
                ?>
            </div>
        </div>
        <div class="userpageFollowerArea">
            <p class="userpageFollowerAreaHeadline singlePageHeadlines">Gefolgte Refferate</p>
            <div class="userpageFollowerAreaContentArea">
                <?php getFollowedActivities(); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>