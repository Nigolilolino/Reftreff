<?php 

add_action("init", "reftref_post_types");

function reftref_post_types(){
    register_post_type("referate", array(
        "show_in_rest" => true,
        "capability_type" => "referat",
        "map_meta_cap" => true,
        "supports"=> array("title","excerpt",'comments', 'thumbnail'),
        "rewrite"=> array("slug"=> "referate"),
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-smiley",
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

    register_post_type("follower", array(

        "supports"=> array("title"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-groups",
        "labels" => array(
            "name" => "Follower",
            "add_new_item" => "Neuen Follower erstellen",
            "edit_item" => "Follower bearbeiten",
            "all_items" => "Alle Follower",
            "singular_name" => "Follower"
        )
    ));

    register_post_type("news", array(
        "show_in_rest" => true,
        "supports"=> array("title", "editor"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-testimonial",
        "labels" => array(
            "name" => "News",
            "add_new_item" => "Neue News erstellen",
            "edit_item" => "News bearbeiten",
            "all_items" => "Alle News",
            "singular_name" => "News"
        )
    ));

    register_post_type("participants", array(

        "supports"=> array("title"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-groups",
        "labels" => array(
            "name" => "Participants",
            "add_new_item" => "Neuen Participant erstellen",
            "edit_item" => "Participant bearbeiten",
            "all_items" => "Alle Participants",
            "singular_name" => "Participant"
        )
    ));
}

?>