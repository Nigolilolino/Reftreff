<?php

add_action("rest_api_init", "AktivityFollowingRoutes");

function AktivityFollowingRoutes(){
    register_rest_route("reftreff/v1", "manageFollow", array(
        "methods" => "POST",
        "callback" => "createFollow"
    ));

    register_rest_route("reftreff/v1", "manageFollow", array(
        "methods" => "DELETE",
        "callback" => "deleteFollow"
    ));

}

function createFollow($data){
    if(is_user_logged_in()){
        $activity = sanitize_text_field($data["activityId"]);
        $user = sanitize_text_field($data["followerId"]);

        $followingQuery = new WP_Query(array(
            "author" => get_current_user_id(),
            "post_type" => "follower",
            "meta_query" => array(
                array(
                    "key" => "followed_activity_id",
                    "compare" => "=",
                    "value" => $activity
                )
            )
        ));

        if($followingQuery->found_posts == 0 AND get_post_type($activity) == "referate"){
            return wp_insert_post(array(
                "post_type" => "follower",
                "post_status" => "publish",
                "post_title" => "test",
                "meta_input" => array(
                    "followed_activity_id" => $activity,
                    "follower_id" => $user
                )
            ));
        }else{
            die("Invalid Id");
        }
    }else{
        die("Only logged in user can subscribe");
    }
}

function deleteFollow($data){
    $followId = sanitize_text_field($data["following"]);
    if(get_current_user_id() == get_post_field("post_author",$followId) AND get_post_type($followId) == "follower"){
        wp_delete_post($followId, true);
        return "deleting complete";
    }else{
        die("You do not have enough permissions");
    }
}