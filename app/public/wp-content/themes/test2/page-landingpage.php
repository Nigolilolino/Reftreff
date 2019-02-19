<html>
    <head>
        <?php wp_head(); ?>
    </head>
    <body>
        <div class="landingpage_headline">
            <h3>WÄHLE EINEN STANDORT</h3>
            <i class="fas fa-map-marker-alt"></i>
            <h1>reftreff</h1>
        </div>
        <div class="landingpage_wrapper" >
        <a href=" <?php echo site_url();?>"><div class="campi_area" style="background-image: url(<?php echo get_theme_file_uri("/images/HFUTut.jpg") ?>);">
                <div class="campi_name">
                    <h3>Tuttlingen</h3>
                </div>
            </div></a>
            <a href=" <?php echo site_url();?>"><div class="campi_area" style="background-image: url(<?php echo get_theme_file_uri("/images/HFUFurtwangen.jpg") ?>);">
                <div class="campi_name">
                    <h3>Furtwangen</h3>
                </div>
            </div></a>
            <a href=" <?php echo site_url();?>"><div class="campi_area" style="background-image: url(<?php echo get_theme_file_uri("/images/HFUVS.jpg") ?>);">
                <div class="campi_name">
                    <h3>Villingen-Schwenningen</h3>
                </div>
            </div></a>
        </div>
    </body>
</html>