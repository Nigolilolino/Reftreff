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
        <h3>Vorname Nachname</h3>
        <p>Referatsleiter</p>
        <p>vorname.nachname@hs-furtwangen.de</p>
    </div>
    <div class="activitySignInArea">
        <div class="activityDateArea">
            <?php 
                $date = get_field('referat_time_and_date', false);
                $date = DateTime::createFromFormat('F j, Y g:i a', $date);
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