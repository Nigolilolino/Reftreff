<!DOCTYPE html>

<html>
    <head>
        <?php wp_head(); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://www.test2.local/wp-content/themes/test2/js/script.js"></script>
    </head>
    <body>
    <header class="site-header">
    <div class="container_header">
<!--<h1 class="school-logo-text float-left"><a href="<?php echo site_url();?>"></a></h1> -->
      <div class = "HFU_Logo_Header_Div">
        <img class = "HFU_Logo_Header" src="<?php echo get_theme_file_uri("/images/HFU_Logo_klein.png") ?>">
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
        <div class="campi_header_link">
        <p>Campi</p>
            <i class="fas fa-map-marked-alt"></i>
        </div>
          <div class = "login_btn_area_header">
            <button type="button" class="login_button_header">Login</button>
          </div>
        <div class="sprach_auswahl">
            <p>DE/EN</p>
        </div>
      </div>
    </div>
  </header>

<!-- <div class="HFU_Logo" style="background-image: url(<?php echo get_theme_file_uri("/images/HFU_Logo_klein.png") ?>);"></div>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li><a href="<?php echo site_url("/about-us");?>">About Us</a></li>
            <li><a href="#">Campi</a></li>
            <li><a href="#">De/En</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--green float-left push-right">Login</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>-->