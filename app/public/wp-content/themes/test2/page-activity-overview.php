<?php 
get_header();
?>
    
<div class="pageBannerActivityOverview">
    <div class="pageBannerImageActivityOverview" style="background-image: url(<?php echo get_theme_file_uri("/images/dummy.png")?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title()?></h1>
        <!--<div class="page-banner__intro">
            <p>Alle Aktivitäten</p>
        </div>-->
    </div>  
</div>

<div class="pageContent">
    <div class="pageActivities">
        <div class="pageActivitiesSports">
        <p class="pageActivitiesSportsHeadline singlePageHeadlines">Sport</p>
            <?php getAllActivities("sport"); ?>
        </div>
        <div class="pageActivitiesFreetime">
            <p class="pageActivitiesFreetimeHeadline singlePageHeadlines">Freizeit</p>
            <?php getAllActivities("freizeit"); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>