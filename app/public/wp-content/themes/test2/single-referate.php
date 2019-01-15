<?php 
get_header();
?>
<div class="singleSidePreviwPicture">
    <?php 
    
    ?>
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
        <button type="button">Referat folgen</button>
    </div>
    <div class="headOfActivityInfo">
        <div class="headOfActivityPicture"> 
        </div>
        <h3><?php the_field("leiter_name")?></h3>
        <p>Referatsleiter</p>
        <p><?php the_field("leiter_email")?></p>
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
        <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="postDate">Sonntag,20:30 Uhr</p>
                    <p class="postContent">Schade, aber ok....</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">Hatte heute eh keine Lust XD</p>
                </div>
            </div>
            <div class="participant">
                <div class="participantPicture"></div>
                <div class="participantInfo">
                    <p class="participantName">Vorname Nachname</p>
                    <p class="participantEmail">Hey Leute, heute fällt das treffen aus.</p>
                </div>
                <input type="text" name="comment" value="">
                <button type="button"></button>
            </div>
    </div>
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
                $date = date('F j, Y', $timestamp);
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