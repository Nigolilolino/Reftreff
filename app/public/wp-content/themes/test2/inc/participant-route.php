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

        $allParticipantsQuery = new WP_Query(array(
            "post_type" => "participants",
            "meta_query" => array(
                array(
                    "key" => "participated_activity_id",
                    "compare" => "=",
                    "value" => $activity
                )
            )
        ));

        $amountParticipants = intval(get_field("maximale_teilnehmer_anzahl", $activity));
        if($amountParticipants != 0 && intval($allParticipantsQuery->found_posts) >= $amountParticipants){
            wp_insert_post(array(
                "post_type" => "waitingList",
                "post_status" => "publish",
                "meta_input" => array(
                    "occupied_activity_id" => $activity,
                    "waiting_user_id" => $user
                )
            ));

            die("Die maximale Teilnehmeranzhal ist bereits erreicht, du wirst aber auf die Warteliste gesetzt und rückst nach sobald ein Platz frei wird.");
        }

        $currentUserFollowsQuery = new WP_Query(array(
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

        if($currentUserFollowsQuery->found_posts == 0 AND get_post_type($activity) == "referate"){
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
    if(get_current_user_id() == get_post_field("post_author",$participationId) OR get_post_type($participationId) == "participants"){
        $activity_id = get_field("participated_activity_id", $participationId);
        wp_delete_post($participationId, true);
/*................................................................ */
        $waitinglistQuery = new WP_Query(array(
            "post_type" => "waitingList",
            'orderby'         => 'post_date',
            'order'           => 'ASC',
            "meta_query" => array(
                array(
                    "key" => "occupied_activity_id",
                    "compare" => "=",
                    "value" => $activity_id
                )
            )
        ));
        $waitinglistEntryId = $waitinglistQuery->post->ID;
        $waitingUserID = get_post_field("waiting_user_id",$waitinglistEntryId);
        wp_delete_post($waitinglistEntryId , true);

        return wp_insert_post(array(
            "post_type" => "participants",
            "post_status" => "publish",
            "meta_input" => array(
                "participated_activity_id" => $activity_id,
                "participant_id" => $waitingUserID
            )
        ));

/*................................................................ */
    }else{
        die("You do not have enough permissions");
    }
}