<?php 
get_header();
?>
<div class="singleSidePreviwPicture">
</div>
<div class="singleSideOverviewArea">
    <div class="singleSideInfo">
        <?php 
            while(have_posts()) {

                the_post(); ?>
                <h2><?php the_title(); ?></h2>
                <?php the_content();?>
            <?php
            }
        ?>
        <button type="button">Referat folgen</button>
    </div>
    <div class="headOfActivityInfo">
        <div class="headOfActivityPicture"> 
        </div>
        <h3>Vorname Nachname</h3>
        <p>Referatsleiter</p>
        <p>vorname.nachname@hs-furtwangen.de</p>
    </div>
    <div class="activitySignInArea">
        <div class="activityDateArea">
        </div>
        <div class="activityParticipantsArea">
            <h3 class="singlePageHeadlines">Teilnehmer</h3>
        </div>
    </div>
</div>
<div class="activityNewsArea">
    <div class="activityBlog">
        <h3 class="singlePageHeadlines">Aktuelles</h3>
    </div>
    <div class="activityFolower">
        <h3 class="singlePageHeadlines">Follower</h3>
    </div>
</div>
<div class="timetable_area">
    <h3 class="singlePageHeadlines">Wochenkalender</h3>
</div>
<div class = "aktivity_area">
    <h3 class="singlePageHeadlines">Das Könnte Dich Auch Interessieren</h3>
<?php
get_activities(0);
?>
</div>
<?php
get_footer();
?>