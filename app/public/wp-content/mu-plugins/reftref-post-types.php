<?php 

add_action("init", "reftref_post_types");

function reftref_post_types(){
    register_post_type("referate", array(
        "supports"=> array("title","excerpt"),
        "rewrite"=> array("slug"=> "referate"),
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-groups",
        "labels" => array(
            "name" => "Referate",
            "add_new_item" => "Neues Referat erstellen",
            "edit_item" => "Referat bearbeiten",
            "all_items" => "Alle Referate",
            "singular_name" => "Referat"
        )
    ));

    register_post_type("infoSites", array(
        "supports"=> array("title","editor","excerpt"),
        "rewrite"=> array("slug"=> "infoSites"),
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-info",
        "labels" => array(
            "name" => "InfoSites",
            "add_new_item" => "Neues InfoSites erstellen",
            "edit_item" => "InfoSites bearbeiten",
            "all_items" => "Alle InfoSites",
            "singular_name" => "InfoSites"
        )
    ));

    register_post_type("campi", array(
        "supports"=> array("title","excerpt"),
        "rewrite"=> array("slug"=> "campi"),
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-welcome-learn-more",
        "labels" => array(
            "name" => "Campi",
            "add_new_item" => "Neuen Campus erstellen",
            "edit_item" => "Campus bearbeiten",
            "all_items" => "Alle Campi",
            "singular_name" => "Campi"
        )
    ));
}

?>