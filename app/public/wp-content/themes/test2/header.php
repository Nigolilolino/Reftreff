<!DOCTYPE html>

<html>
    <head>
        <?php wp_head(); ?>
        <?php updateTimes(); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
    <header class="site-header">
      <div class="container_header">

        <div class = "HFU_Logo_Header_Div">
          <a href="<?php echo site_url();?>"><img class = "HFU_Logo_Header" src="<?php echo get_theme_file_uri("/images/HFU_Logo_klein.png") ?>"></a>
        </div>

          <div class = "Referate_Header">
            <div class="dropdown">
              <button onclick="myFunction()" class="dropbtn">Referate</button>
              <div id="dpMenue" class="dropdown-content">
                <div class="dpCategories">
                  <p>Sport</p>
                  <?php 
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
                        <a href="<?php the_permalink();?>"><p><?php the_title();?></p></a>
                      <?php
                      wp_reset_postdata();
                    }
                  ?>
                </div>
                <div class="dpCategories">
                  <p>Freizeit</p>
                  <?php 
                    $args = array(
                      'numberposts'	=> -1,
                      'post_type'		=> 'referate',
                      'meta_query'	=> array(
                        'relation'		=> 'OR',
                        array(
                          'key'		=> 'referate_tags',
                          'value'		=> 'freizeit',
                          'compare'	=> 'LIKE'
                        ),
                        array(
                          'key'		=> 'referate_tags',
                          'value'		=> 'unterhaltung',
                          'compare'	=> 'LIKE'
                        ),
                      )
                    );
                    $homepageReferate = new WP_Query($args);

                    while($homepageReferate->have_posts()){
                        $homepageReferate->the_post(); ?>
                        <a href="<?php the_permalink();?>"><p><?php the_title();?></p></a>
                      <?php
                      wp_reset_postdata();
                    }
                  ?>
                </div>
              </div>
            </div>
            <i class="fa fa-angle-down"></i>
          </div>

          <div class = "Header_Link_Area">
            <a href="./landingpage/"><div class="campi_header_link">
              <p>Campi</p>
                <i class="fas fa-map-marked-alt"></i>
            </div></a>

            <?php 
            if(is_user_logged_in()){ ?>
              <div class = "login_btn_area_header">
              <a href="./blog/userpage/"><div class ="login_button_user_avatar"><?php echo get_avatar(get_current_user_id(), 40) ?></div></a>
                <a href="<?php echo wp_logout_url(home_url() ); ?>"><button type="button" class="login_button_header">Log Out</button></a>
              </div>
            <?php }else{ ?>
              <div class = "login_btn_area_header">
                <a href="<?php echo wp_login_url() ?>"><button type="button" class="login_button_header">Log In</button></a>
              </div>
            <?php }
            ?>
            <div class="sprach_auswahl">
                <p>DE/EN</p>
            </div>
          </div>
          
  </header>

