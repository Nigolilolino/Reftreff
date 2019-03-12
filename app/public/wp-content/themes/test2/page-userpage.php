<?php 
get_header();
?>
<div class="page-banner">
  <div class="page-banner__bg-image_ref" style="background-image: url(<?php echo get_theme_file_uri("/images/dummy.png") ?>);">
  </div>
  <div class="page-banner__content container t-center c-white">
  </div> 
</div>

<div class="timetable_area">
    <h3 class="singlePageHeadlines">Mein Wochenkalender</h3>
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

<?php
get_footer();
?>