<?php

add_action("rest_api_init", "AktivityParticipantRoutes");

function AktivityParticipantRoutes(){
    register_rest_route("reftreff/v1", "manageParticipation", array(
        "methods" => "POST",
        "callback" => "createParticipation"
    ));

    register_rest_route("reftreff/v1", "manageParticipation", array(
        "methods" => "DELETE",
        "callback" => "deleteParticipation"
    ));

}

function createParticipation($data){
    if(is_user_logged_in()){
        $activity = sanitize_text_field($data["activityId"]);
        $user = sanitize_text_field($data["participantId"]);

        $followingQuery = new WP_Query(array(
            "author" => get_current_user_id(),
            "post_type" => "participants",
            "meta_query" => array(
                array(
                    "key" => "participated_activity_id",
                    "compare" => "=",
                    "value" => $activity
                )
            )
        ));

        if($followingQuery->found_posts == 0 AND get_post_type($activity) == "referate"){
            return wp_insert_post(array(
                "post_type" => "participants",
                "post_status" => "publish",
                "meta_input" => array(
                    "participated_activity_id" => $activity,
                    "participant_id" => $user
                )
            ));
        }else{
            die("Invalid Id");
        }
    }else{
        die("Only logged in users can subscribe");
    }
}

function deleteParticipation($data){
    $participationId = sanitize_text_field($data["participating"]);
    if(get_current_user_id() == get_post_field("post_author",$participationId) AND get_post_type($participationId) == "participants"){
        wp_delete_post($participationId, true);
        return "deleting complete";
    }else{
        die("You do not have enough permissions");
    }
}