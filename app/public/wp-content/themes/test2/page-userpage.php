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
            <p class="userpageBannerGreetingAddition">Lorem ipsum dolor sit amet, 
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
                et dolore magna aliquyam</p>
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
            <div class="userpageNewsAreaContent">
                <p>Heute fällt Musik leider aus, bis nächste Woche</p>
            </div>
            <div class="userpageNewsAreaContent">
                <p>Schwimmen wird aus morgen verschoben</p>
            </div>
            <div class="userpageNewsAreaContent">
                <p>Anime fängt heut eine Stunde später an</p>
            </div>
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