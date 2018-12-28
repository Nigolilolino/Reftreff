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
        "post_type" => "referate",
    ));

    while($homepageReferate->have_posts()){
        $homepageReferate->the_post();  ?>
        
        <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
    <?php }
}

function get_Filters(){
    $field_key = "field_5c17e7be6b9ef";
    $field = get_field_object($field_key);

    if( $field )
    {
        
        foreach( $field['choices'] as $key => $value )
            {
                echo '<input type="checkbox" class="filterCheckboxes" name= '.$value.' value='.$value.' onclick="refreshActivities()">';
                echo '<div class="filter">' . $value . '</div>';
            }
        
    }
}

?>

<script>
    function refreshActivities(){
        var checkboxes = document.getElementsByClassName("filterCheckboxes");
        var checkboxValues = [];
        console.log(checkboxes);

        for(var i = 0; i < checkboxes.length; i++){
            if(checkboxes[i].checked){
                checkboxValues.push(checkboxes[i].value);
            }
        }
        console.log(checkboxValues);

    }
</script>