
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

if($_POST['functionname'])
   get_activities(stripslashes( $_POST['arguments'] ));


function get_activities($array){
    if($array == 0){
    $args = array(
        'post_type' => 'referate',
    );
    
    $homepageReferate = new WP_Query($args);

    while($homepageReferate->have_posts()){
        $homepageReferate->the_post();  ?>
        
        <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
    <?php }
    }else{
        
        $args = str_replace( '"','',$array );

        echo "<script> alert('testBlub')</script>";

        $homepageReferate2 = new WP_Query($args);
        while($homepageReferate2->have_posts()){
            $homepageReferate2->the_post();  ?>
        <?php }
        wp_reset_query();
        
    }
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
            };  
    };
}
?>

<script>

//Funktionen für die Filter..........................................................
    function refreshActivities(){
        var checkboxes = document.getElementsByClassName("filterCheckboxes");
        var checkboxValues = [];
        console.log(checkboxes);
        
        for(var i = 0; i < checkboxes.length; i++){
            if(checkboxes[i].checked){
                checkboxValues.push(checkboxes[i].value);
            }
        }
        prepareArguments(checkboxValues);

    function prepareArguments(_values){
            var args = "array('post_type' => 'referate','meta_query' => array("
            
            for(var i = 0; i < _values.length; i++){
                console.log(_values[i]);
                args += "array('key' => 'referate_tags','value' => \'"+_values[i]+"\','compare' => 'LIKE'),"
            }
            args += "),);";
            removeAvtivities();
            
            jQuery.ajax({
                type: "Post",
                url: "index.php",
                dataType: "script",
                data: {functionname: "get_activities", arguments: args},

                success: function(){
                    alert(args);
                }
            });
        };
};

function removeAvtivities(){
    var activitieArea = document.getElementsByClassName("aktivity_area");
    while(activitieArea[0].firstChild) 
    activitieArea[0].removeChild(activitieArea[0].firstChild);
}

//....................................................................................

// Funktionen für das Dropdownmenü der Startseite....................................

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

function myFunction() {
  document.getElementById("dpMenue").classList.toggle("show");
}


window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

//............................................................................................
</script>

