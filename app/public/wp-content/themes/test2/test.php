<?php 
get_header();
?>

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

    <?php 
        $activityLeaderId = get_the_author_id();
        $activityLeader = get_userdata($activityLeaderId);
    ?>

    <div class ="headOfActivityAndDownloadArea">
        <div class="headOfActivityInfo">
            <div class="headOfActivityPicture">
                <?php echo get_avatar($activityLeaderId); ?>
            </div>
            <div class="headOfActivityid">
                <h3><?php echo $activityLeader->user_login?></h3>
                <p>Referatsleiter</p>
                <p><?php echo $activityLeader->user_email; ?></p>
            </div>
        </div>
        
        <div class="singleSideDownloadArea">
        <hr>
            <h4>DOWNLOADS</h4>
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
</div>

<div id="overlayLocationWindow" class="overlay">
</div>

<div id="locationWindow" class="locationWindow">
    <div class="locationMapArea">
    </div>
    <div class="locationInfoArea">
            <p class="locationBuilding"><?php the_field('raumnummer') ?></p>
            <P class="locationStreet"><?php the_field('strase_und_hausnummer'); ?></p>
            <p class="locationCity"><?php the_field('stadt'); ?></p>
            <p class="locationDescription"><?php the_field("zusatzliche_angaben") ?></p>
    </div>
</div>

<div class="activitySignInArea">
    <div class="activityDateArea">
        <?php 
            $tage = array("Monday" => "Montag", "Tuesday" => "Dienstag","Wednesday" => "Mittwoch","Thursday" => "Donnerstag","Friday" => "Freitag", "Saturday" => "Samstag","Sunday" => "Sonntag");
            $Monate = array("January" => "Januar", "February" => "Februar", "March" => "März", "April" => "April", "May" => "Mai", "June" => "Juni", "July" => "Juli", "August" => "August", "September" => "September", "October" => "Oktober", "November" => "November", "December" => "Dezember");
            $date = get_field('referat_time_and_date', false);
            $date = DateTime::createFromFormat('Y-m-d H:i', $date);
            $time = $date->format('H:i');
            $date = $date->format('j. F Y');
            $timestamp = strtotime($date);
            $day = date('l', $timestamp);
            echo "<p class='activityDate'>$tage[$day], $date</p>";
            echo "<p class='activityTime'>$time</p>"; 
        ?>
        <p id="locationPopupActivator" data-active="false"><?php the_field('strase_und_hausnummer'); ?></p>
        <p><?php the_field('raumnummer') ?></p> <?php

        $participationStatus = "no";

        if(is_user_logged_in()){
            $participationQuery = new WP_Query(array(
                "author" => get_current_user_id(),
                "post_type" => "participants",
                "meta_query" => array(
                    array(
                        "key" => "participated_activity_id",
                        "compare" => "=",
                        "value" => get_the_ID()
                    )
                )
            ));

            if($participationQuery->found_posts){
                $participationStatus = "yes";
            }
        }
        ?>

        <button id="participationBtn" type="button" data-userId="<?php echo get_current_user_id(); ?>" data-participation="<?php echo $participationQuery->posts[0]->ID; ?>" data-activity= <?php the_ID(); ?> data-exists= <?php echo $participationStatus ?>>Teilnehmen</button>
    </div>
    <div class="activityParticipantsArea">
        <h3 class="singlePageHeadlines">Teilnehmer</h3>
        <?php $args = array(
        'post_type'		=> 'participants',
        'numberposts'	=> -1,
        'meta_query'	=> array(
            'relation'		=> 'OR',
            array(
                'key'		=> 'participated_activity_id',
                'value'		=> get_the_ID(),
                'compare'	=> '='
                ),
            )
        );
        
        $participantsQuery = new WP_Query($args);
                while($participantsQuery->have_posts()){
                $participantsQuery->the_post(); 
                $participant = get_userdata(get_field("participant_id"));
                ?>
                <div class="participant">
                    <div class="participantPicture"><?php echo get_avatar($participant->ID) ?></div>
                    <div class="participantInfo">
                        <p class="participantName"><?php echo $participant->user_login ?></p>
                        <p class="participantEmail"><?php echo $participant->user_email ?></p>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            }
        ?>
    </div>
</div>

<div class="activityNewsArea">
    <div class="activityBlog">
        <h3 class="singlePageHeadlines">Aktuelles</h3>
        <?php comments_template(); ?>       
    <div class="activityFolower">
        <h3 class="singlePageHeadlines">Follower</h3>

            <?php $args = array(
            'post_type'		=> 'follower',
            'numberposts'	=> -1,
            'meta_query'	=> array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'followed_activity_id',
                    'value'		=> get_the_ID(),
                    'compare'	=> '='
                    ),
                )
            );
            
            $followerQuery = new WP_Query($args);
                  while($followerQuery->have_posts()){
                    $followerQuery->the_post(); 
                    $follower = get_userdata(get_field("follower_id"));
                    ?>
                   <div class="participant">
                        <div class="participantPicture"><?php echo get_avatar($follower->ID) ?></div>
                        <div class="participantInfo">
                            <p class="participantName"><?php echo $follower->user_login ?></p>
                            <p class="participantEmail"><?php echo $follower->user_email ?></p>
                        </div>
                    </div>
                  <?php
                  wp_reset_postdata();
                }
            ?>
    </div>
</div>

<div class="timetable_area">
    <h3 class="singlePageHeadlines">Wochenkalender</h3>
    <?php createTimetable(); ?>
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