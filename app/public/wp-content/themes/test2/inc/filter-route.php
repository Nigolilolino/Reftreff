<?php

add_action("rest_api_init", "FilterRoutes");

function FilterRoutes(){
    register_rest_route("reftreff/v1", "manageFilter", array(
        "methods" => "POST",
        "callback" => "createFilter"
    ));
}

function createFilter($_values){
    $data = json_decode(stripslashes($_values['checkboxValues']));
    
}
