
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

/*if (isset($_POST['callFunc1'])) {
    queryNewActivities(stripslashes($_POST['callFunc1']));
}*/

function get_activities($mode){
    wp_reset_query();

    if($mode == "main"){
        $args = array(
            'post_type'		=> 'referate',
        );
        
        $homepageReferate = new WP_Query($args);

        while($homepageReferate->have_posts()){
            $homepageReferate->the_post();  ?>
            
            <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
        <?php 
        wp_reset_postdata();
        }
    }else if($mode = "sub"){
        $tags = get_field('referate_tags');
        foreach($tags as $value){
            if($value == "sport" || $value == "bewegung"){
                $args = array(
                    'numberposts'	=> -1,
                    'post_type'		=> 'referate',
                    'meta_query'	=> array(
                      'relation'		=> 'OR',
                      array(
                        'key'		=> 'referate_tags',
                        'value'		=> 'sport',
                        'compare'	=> 'LIKE'
                      ),
                    )
                  );
                  $homepageReferate = new WP_Query($args);
                  while($homepageReferate->have_posts()){
                    $homepageReferate->the_post(); ?>
                    <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
                  <?php
                  wp_reset_postdata();
                }
                break;
            }else if($value == "denken"){
                $args = array(
                    'numberposts'	=> -1,
                    'post_type'		=> 'referate',
                    'meta_query'	=> array(
                      'relation'		=> 'OR',
                      array(
                        'key'		=> 'referate_tags',
                        'value'		=> 'denken',
                        'compare'	=> 'LIKE'
                      ),
                    )
                  );
                  $homepageReferate = new WP_Query($args);
                  while($homepageReferate->have_posts()){
                    $homepageReferate->the_post(); ?>
                    <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
                  <?php
                  wp_reset_postdata();
                }
                break;
            }else if($value == "kreativ"){
                $args = array(
                    'numberposts'	=> -1,
                    'post_type'		=> 'referate',
                    'meta_query'	=> array(
                      'relation'		=> 'OR',
                      array(
                        'key'		=> 'referate_tags',
                        'value'		=> 'kreativ',
                        'compare'	=> 'LIKE'
                      ),
                    )
                  );
                  $homepageReferate = new WP_Query($args);
                  while($homepageReferate->have_posts()){
                    $homepageReferate->the_post(); ?>
                    <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
                  <?php
                  wp_reset_postdata();
                }
                break;
            }else if($value =="entspannen"){
                $args = array(
                    'numberposts'	=> -1,
                    'post_type'		=> 'referate',
                    'meta_query'	=> array(
                      'relation'		=> 'OR',
                      array(
                        'key'		=> 'referate_tags',
                        'value'		=> 'entspannen',
                        'compare'	=> 'LIKE'
                      ),
                    )
                  );
                  $homepageReferate = new WP_Query($args);
                  while($homepageReferate->have_posts()){
                    $homepageReferate->the_post(); ?>
                    <a href=" <?php the_permalink(); ?>"><div class = 'activities' style="background-image: url(<?php echo the_field("referat_titelbild") ?>);" ><strong class='activity_title'><?php the_title()?></strong></div></a>
                  <?php
                  wp_reset_postdata();
                }
                break;
            }else{

            }
        }
    }
}

function get_Filters(){
    $field_key = "field_5c17e7be6b9ef";
    $field = get_field_object($field_key);

    if( $field )
    {
        foreach( $field['choices'] as $key => $value )
            {
                echo '<div class="filterbox"><input type="checkbox" class="filterCheckboxes" name= '.$value.' value='.$value.' onclick="refreshActivities()">';
                echo '<div class="filter">' . $value . '</div></div>';
            };  
    };
}

function queryNewActivities($args){
    $args = array(
        'numberposts' => -1,
        'post_type' => 'referate',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'referate_tags',
                'value' => 'Sport',
                'compare' => 'LIKE'
            ),
        ),
    );
    $links = array();
    $homepageReferate = new WP_Query($args);

    while($homepageReferate->have_posts()){
        $homepageReferate->the_post();
        array_push($links, the_permalink() );
    }
    echo json_encode($links);
    wp_reset_postdata();
    
    
}
?>

