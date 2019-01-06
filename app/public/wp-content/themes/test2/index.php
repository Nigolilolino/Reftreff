<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("/images/schwimmen.jpg") ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h2 class="headline headline--medium"><strong>Jetzt</strong> aktiv</h2>
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
<p>Colors: <?php the_field('referate_tags',21); ?></p>
<?php
get_activities(0);
?>
</div>
</div>
<div class="call_to_action_area">
<div class="call_to_action_text">
  <h1>Nichts Dabei?</h1>
  <p>Du hast dein Referat noch nicht gefunden und denkst das etwas fehlt? Dann gründe doch einfach ein neues Referat! Lorem ipsum dolor sit amet, consetetur sadipscing.</p>
</div>
<div class="call_to_action_button">
</div>
</div>
<div class="timetable_area">

</div>

<?php
get_footer();
?>

<script>
function fillDropdown() {
    var dropdown = document.getElementsByClassName("dpCategories")[0];
    //<a href="#">Link 1</a>
    <?php 

    $args = array(
        'post_type' => 'referate'
    );

        $homepageReferate = new WP_Query($args);

        while($homepageReferate->have_posts()){
            
            $homepageReferate->the_post(); ?>
           
            option = document.createElement('a');
            option.innerHTML = "<?php the_title()?>";
            option.setAttribute('href', '<?php the_permalink(); ?>');
            dropdown.appendChild(option);

            <?php

        } 
    
    ?>
}
</script>