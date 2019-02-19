<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("/images/schwimmen.jpg") ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h2 class="headline headline--medium"><strong>JETZT</strong> aktiv</h2>
      <h2 class="headline headline--medium">werden und neue</h2>
      <h2 class="headline headline--medium">Leute treffen!</h2>
    </div>
</div>
<div class ="filler">
<p class="Filter_Area_Headline">Referate</p>
  <div class= "filter_sign_area" >
   <i class="fa fa-filter"></i>
   <p class="filter_Name">Filter</p>
  </div>
</div>
<div class = "filter_area">
  <?php
    get_Filters();
  ?>
</div>
<div class = "aktivity_area">
<div class="test">
<?php
get_activities("main");
?>
</div>
</div>
    <div class="call_to_action_area">
        <div class="call_to_action_text">
            <h1>Nichts Dabei?</h1>
            <p>Du hast dein Referat noch nicht gefunden und denkst das etwas fehlt? Dann gründe doch einfach ein neues Referat! Lorem ipsum dolor sit amet, consetetur sadipscing.</p>
            <button class="cta-button">Kontakt aufnehmen</button>
        </div>
        <div class="call_to_action_button">
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

<?php
get_footer();
?>

