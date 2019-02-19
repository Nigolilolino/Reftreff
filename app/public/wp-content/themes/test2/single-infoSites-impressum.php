<?php 
get_header();
?>

<div class="disclaimer">
    <?php the_content()?>
<div>

<div class="impressum">
    <h1>Impressum</h1>
    <h2>Betreiber</h2>
    <div class="impressumLogo" style="background-image: url(<?php echo the_field("impressum_logo") ?>);">
    </div>
    <div class="impressumAdress">
        <?php the_field("impressum_name");?>
        <br>
        <?php the_field("impressum_strasse");?>
        <br>
        <?php the_field("impressum_stadt");?>
        <br>
    </div>
    <div class="impressumCommunication">
        <p>Telefon: <?php the_field("impressum_telefonnummer");?></p>
        <p>Telefax: <?php the_field("impressum_fax");?></p>
        <p>E-Mail: <?php the_field("impressum_email");?></p>
    </div>
    <h2>Ansprechpartner</h2>
    <div class="impressumContactPerson">
        <div class="impressumContactPersonName"></div>
        <div class="impressumContactPersonEmail">
            <?php the_field("impressum_ansprechpartner_name");?>
            <p>E-Mail: <?php the_field("impressum_ansprechpartner_email");?></p>
        </div>
    </div>

</div>

<?php
get_footer();
?>