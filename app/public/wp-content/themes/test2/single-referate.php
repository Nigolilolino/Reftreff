<?php 
get_header();
?>
<div class="page-banner">
  <div class="page-banner__bg-image_ref" style="background-image: url(<?php echo the_field("header_referate") ?>);"></div>
    <div class="page-banner__content container t-center c-white">
    </div>
  <div>  
</div>
<div class="singleSidePreviwPicture">
   
</div>
<div class="singleSideOverviewArea">
    <div class="singleSideInfo">
        <?php 
            while(have_posts()) {

                the_post(); ?>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt();?>
            <?php
            }
        ?>

        <?php

        $followingStatus = "no";

        if(is_user_logged_in()){
            
            $followingQuery = new WP_Query(array(
                "author" => get_current_user_id(),
                "post_type" => "follower",
                "meta_query" => array(
                    array(
                        "key" => "followed_activity_id",
                        "compare" => "=",
                        "value" => get_the_ID()
                    )
                )
            ));
    
            if($followingQuery->found_posts){
                $followingStatus = "yes";
            }
        }

        ?>
        <button id="activityFollowBtn" type="button" data-userId="<?php echo get_current_user_id(); ?>" data-follow="<?php echo $followingQuery->posts[0]->ID; ?>" data-activity= <?php the_ID(); ?> data-exists= <?php echo $followingStatus ?>>Referat folgen</button>
    </div>

    <div class ="headOfActivityAndDownloadArea">
        <div class="headOfActivityInfo">
            <div class="headOfActivityPicture"> 
            </div>
            <h3><?php the_field("leiter_name")?></h3>
            <p>Referatsleiter</p>
            <p><?php the_field("leiter_email")?></p>
            <hr>
        </div>

        <div class="singleSideDownloadArea">
            <h2>Downloads</h2>
            <?php 
            for($i=1; $i < 4; $i++){
                if( have_rows('downloads' . $i) ):
                    while ( have_rows('downloads' . $i) ) : the_row();
                        ?> <a href="<?php the_sub_field('download_link'); ?>" target="blank"><p class="downloads_label"><?php the_sub_field('download_label'); ?> </p></a> <?php
                    endwhile;
                else :
                    ?> <p class="default-value"> Für dieses Referat sind keine Dateien vorhanden. </p> <?php
                    break;
                endif;
            }
            ?>
        </div>
    </div>

    <div class="activitySignInArea">
        <div class="activityDateArea">
            <?php 
                $date = get_field('referat_time_and_date', false);
                $date = DateTime::createFromFormat('Y-m-d H:i', $date);
                $time = $date->format('H:i');
                $date = $date->format('j. F Y');
                $timestamp = strtotime($date);
                $day = date('l', $timestamp);
                echo "<p class='activityDate'>$day, $date</p>";
                echo "<p class='activityTime'>$time</p>"; 
            ?>
            <p><?php the_field('strase_und_hausnummer'); ?></p>
            <p><?php the_field('raumnummer') ?></p> <?php
            ?>
            <button type="button">Teilnehmen</button>
        </div>
        <div class="activityParticipantsArea">
            <h3 class="singlePageHeadlines">Teilnehmer</h3>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="activityNewsArea">
    <div class="activityBlog">
        <h3 class="singlePageHeadlines">Aktuelles</h3>
        
               <?php comments_template(); ?>
                <!--<input type="text" name="comment" value="">
                <button type="button">send</button> -->
            
    <div class="activityFolower">
        <h3 class="singlePageHeadlines">Follower</h3>
        <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">vorname.nachname@hs-furtwangen.de</p>
                </div>
            </div>
    </div>
</div>
<div class="timetable_area">
    <h3 class="singlePageHeadlines">Wochenkalender</h3>
    <div class="timetable">
        <div id="monday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("monday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">Monntag</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
                <?php getTimetableInput($timestamp); ?>
            </div>
        </div>
        <div id="tuesday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("tuesday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">Dienstag</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php getTimetableInput($timestamp); ?>
            </div>
        </div>
        <div id="wednesday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("wednesday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">Mittwoch</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php getTimetableInput($timestamp); ?>
            </div>
        </div>
        <div id="thursday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("thursday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">Donnerstag</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php getTimetableInput($timestamp); ?>
            </div>
        </div>
        <div id="friday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("friday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">Freitag</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php getTimetableInput($timestamp); ?>
            </div>
        </div>
    </div>
</div>
<div class = "aktivity_area">
    <h3 class="singlePageHeadlines">Das Könnte Dich Auch Interessieren</h3>
<?php
get_activities("sub");
?>
</div>
<?php
get_footer();
?>