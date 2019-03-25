
<?php 

require get_theme_file_path("/inc/following-route.php");
require get_theme_file_path("/inc/comments-route.php");
require get_theme_file_path("/inc/participant-route.php");
require get_theme_file_path("/inc/filter-route.php");

function reftreff_files() {
    wp_enqueue_script("MainJS", get_theme_file_uri("/js/scripts-bundled.js"), NULL, "1.0", true);
    wp_enqueue_style("customGoogleFonds", "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
    wp_enqueue_style("font_awesome", "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    wp_enqueue_style("reftreffMainStyles", get_stylesheet_uri());
    wp_enqueue_script( "script", get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);
    wp_localize_script("MainJS", "reftreffData", array(
      "root_url" => get_site_url(),
      "nonce" => wp_create_nonce("wp_rest")
    ));
}

add_action("wp_enqueue_scripts","reftreff_files");

function reftreffFeatures(){
    add_theme_support("title-tag");
}
add_action("after_setup_theme", "reftreffFeatures");

//Weitereitung und Darstellung von und für Subscriber

add_action("admin_init", "rediredtingSubscribersToFrontend");

function rediredtingSubscribersToFrontend(){
  $currentUser = wp_get_current_user();
  
  if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == "subscriber"){
    wp_redirect(site_url("/"));
    exit;
  }
}

add_action("wp_loaded", "blockAdminBarForSubs");

function blockAdminBarForSubs(){
  $currentUser = wp_get_current_user();
  
  if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == "subscriber"){
    show_admin_bar(false);
  }
}

//Änderung des Log In Screens
add_filter("login_headerurl", "newHeaderURL");

function newHeaderURL(){
  return esc_url(site_url("/"));
}

add_action("login_enqueue_scripts", "newLoginPageCSS");

function newLoginPageCSS(){
  wp_enqueue_style("reftreffMainStyles", get_stylesheet_uri());
}

add_theme_support("html5", array("comment-list", "comment-form"));

//....................................................................................


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

function getFollowedActivities(){

  $follows = get_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'follower',
    'meta_query' =>array(
      array(
        'key' => 'follower_id',
        'compare' => "=",
        'value' => get_current_user_id()
      )
    ),
  ));

  if(count($follows) == 0){
    ?> <p>Noch folgst du keinem Referat</p> <?php
  }else{
    foreach($follows as $f){
      $followedActivityID = get_field("followed_activity_id", $f->ID);
      $test = get_field("leiter_name", $followedActivityID);
      ?>
      <a href=" <?php the_permalink($followedActivityID); ?>"><div class = 'activitiesUserpages' style="background-image: url(<?php echo the_field("referat_titelbild", $followedActivityID) ?>);" ><strong class='activity_title'><?php echo get_the_title($followedActivityID)?></strong></div></a>
      <?php
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
                echo '<div class="filterbox"><input type="checkbox" class="filtercheckboxes" name= '.$value.' value='.$value.' onclick="refreshActivities()">';
                echo '<label class="filter">' . $value . '</label></div>';
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

//.....................................Funktionen des Kalenders................................
function updateTimes(){
  $posts = get_posts(array(
    'post_type'			=> 'referate',
    'posts_per_page'	=> -1
  ));

  if($posts): ?>
    <?php foreach( $posts as $p ):
        $id = $p->ID;
        $timeNow = new DateTime();
        $oldTimeActivity = get_field('referat_time_and_date', $id);
        $dateObjectActivity = new DateTime($oldTimeActivity);
        $dateNextSunday = $dateObjectActivity->modify('next sunday');
        $dateObjectActivity = new DateTime($oldTimeActivity);
        $dateNextSunday->format('Y-m-d H:i');
        
        if($dateNextSunday < $timeNow){
          $dateObjectActivity->add(new DateInterval('P7D'));
          $timestringActivity = $dateObjectActivity->format('Y-m-d H:i'); 
          update_field("referat_time_and_date", $timestringActivity, $id);
        }
    ?>
    <?php endforeach; ?>
  <?php endif;
  wp_reset_postdata();
}

function createTimetable(){
  ?>
  <div id="monday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("monday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">MONTAG</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
                <?php
                if(get_the_ID() == 122){
                  getTimetableInputForTheUserpage($timestamp);
                }else{
                  getTimetableInputAllActivities($timestamp);
                } 
                ?>
            </div>
        </div>
        <div id="tuesday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("tuesday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">DIENSTAG</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php
                if(get_the_ID() == 122){
                  getTimetableInputForTheUserpage($timestamp);
                }else{
                  getTimetableInputAllActivities($timestamp);
                } 
                ?>
            </div>
        </div>
        <div id="wednesday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("wednesday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">MITTWOCH</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php
                if(get_the_ID() == 122){
                  getTimetableInputForTheUserpage($timestamp);
                }else{
                  getTimetableInputAllActivities($timestamp);
                } 
                ?>
            </div>
        </div>
        <div id="thursday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("thursday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">DONNERSTAG</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php
                if(get_the_ID() == 122){
                  getTimetableInputForTheUserpage($timestamp);
                }else{
                  getTimetableInputAllActivities($timestamp);
                } 
                ?>
            </div>
        </div>
        <div id="friday" class="timetableDays">
            <div class="timetableDates">
            <?php $timestamp = strtotime("friday this week");
                $date = date('d.m.Y', $timestamp);
            ?>
                <p class="timetableDatesDay">FREITAG</p>
                <p class="timetableDatesDate"><?php echo $date ?></p>
            </div>
            <div class="timetableActivities">
            <?php
                if(get_the_ID() == 122){
                  getTimetableInputForTheUserpage($timestamp);
                }else{
                  getTimetableInputAllActivities($timestamp);
                } 
                ?>
            </div>
        </div>
        <?php
}

//Kalender allgemein
function getTimetableInputAllActivities($date){
  $dayBefore = strtotime('0 hours 2 seconds', $date);
  $dayAfter = strtotime('23 hours 59 seconds', $date);
  $dayBeforeInString = date('Y-m-d H:i:s', $dayBefore);
  $dayAfterInString = date('Y-m-d H:i:s', $dayAfter);

  $posts = get_posts(array(
      'posts_per_page'	=> -1,
      'post_type'			=> 'referate',
      'meta_query' 		=> array(
          array(
              'key'			=> 'referat_time_and_date',
              'compare'		=> 'BETWEEN',
              'value'			=> array($dayBeforeInString, $dayAfterInString),
              'type'			=> 'DATETIME'
          )
      ),
      'order'				=> 'ASC',
      'orderby'			=> 'meta_value',
      'meta_key'			=> 'referat_time_and_date',
      'meta_type'			=> 'DATETIME'
  ));
  
  if( $posts ): ?>
          <?php foreach( $posts as $p ):
              $date = get_field('referat_time_and_date', $p->ID);
              $dateTime = substr($date,11);
          ?>
          <div class="timetableActivitiesTimeAndName">
              <p class="timetableActivitiesTime"><?php echo $dateTime ?></p>
              <p class="timetableActivitiesName"><?php echo $p->post_title; ?></p>
          </div>
          <?php endforeach; ?>
  
  <?php endif;
}

//Kalender cunstomized für user

function getTimetableInputForTheUserpage($date){
  $dayBefore = strtotime('0 hours 2 seconds', $date);
  $dayAfter = strtotime('23 hours 59 seconds', $date);
  $dayBeforeInString = date('Y-m-d H:i:s', $dayBefore);
  $dayAfterInString = date('Y-m-d H:i:s', $dayAfter);

  $posts = get_posts(array(
      'posts_per_page'	=> -1,
      'post_type'			=> 'referate',
      'meta_query' 		=> array(
          array(
              'key'			=> 'referat_time_and_date',
              'compare'		=> 'BETWEEN',
              'value'			=> array($dayBeforeInString, $dayAfterInString),
              'type'			=> 'DATETIME'
          )
      ),
      'order'				=> 'ASC',
      'orderby'			=> 'meta_value',
      'meta_key'			=> 'referat_time_and_date',
      'meta_type'			=> 'DATETIME'
  ));
  
  if( $posts ): ?>
          <?php foreach( $posts as $p ):
            $test = get_posts(array(
              'posts_per_page' => -1,
              'post_type' => 'follower',
              'meta_query' =>array(
                array(
                  'key' => 'follower_id',
                  'compare' => "=",
                  'value' => get_current_user_id()
                )
              ),
            ));
            
            foreach($test as $t){
              $followedActivityID = get_field("followed_activity_id", $t->ID);
              
              if($followedActivityID == $p->ID){
                
                $date = get_field('referat_time_and_date', $p->ID);
                $dateTime = substr($date,11);
                ?>
                <div class="timetableActivitiesTimeAndName">
                    <p class="timetableActivitiesTime"><?php echo $dateTime ?></p>
                    <p class="timetableActivitiesName"><?php echo $p->post_title; ?></p>
                </div>
                <?php
              }
            }
            ?>
          <?php endforeach; ?>
  <?php endif;
}

//.....................................Ende Kalender-Funktionen...............................


?>


