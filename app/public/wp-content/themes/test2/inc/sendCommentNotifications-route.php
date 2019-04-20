<?php 

add_action("rest_api_init", "SendCommentNotificationsRoutes");

function SendCommentNotificationsRoutes(){
    register_rest_route("reftreff/v1", "sendNotification", array(
        "methods" => "POST",
        "callback" => "sendMail"
    ));
}

function sendMail($data){
    $contend = sanitize_text_field($data["daten"]);

    $to = 'nicojack@gmx.de';
    $subject = 'The subject';
    $body = 'test';
    
    return wp_mail( $to, $subject, $body);
}