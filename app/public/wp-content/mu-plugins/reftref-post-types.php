<?php 

add_action("init", "reftref_post_types");

function reftref_post_types(){
    register_post_type("referate", array(
        "supports"=> array("title","editor","excerpt"),
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
}

?>