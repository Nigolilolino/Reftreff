<?php 

function reftreff_files() {
    wp_enqueue_script("MainJS", get_theme_file_uri("/js/scripts-bundled.js"), NULL, "1.0", true);
    wp_enqueue_style("customGoogleFonds", "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
    wp_enqueue_style("font_awesome", "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    wp_enqueue_style("reftreffMainStyles", get_stylesheet_uri());
}

add_action("wp_enqueue_scripts","reftreff_files");

function reftreffFeatures(){
    add_theme_support("title-tag");
}
add_action("after_setup_theme", "reftreffFeatures");

function get_activities(){
    /* Geht alle im "Referate" angelegten Dateien durch und erzeugt ein Div mit passendem Bild und Text.
    Dient zusätzlich auch als Link zur jeweiligen Referatseite*/ 
    $homepageReferate = new WP_Query(array(
        "post_type" => "referate"
    ));

    while($homepageReferate->have_posts()){
        $homepageReferate->the_post();  ?>
        
        <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
    <?php }
    /*echo $numberOfPages;
    print_r($page_title);
    */
}

function get_Filters(){
    $field = get_field_object('referate_tags',[$post_id = 21]);
    ?>
    <p><?php echo $field['value'] ?></p>
    <?php
    $test = get_post_field( "referate_tags", 21);
    print_r($test);
    print_r($test);
}

?>