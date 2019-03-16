<?php 

add_action("rest_api_init", "DeletingCommentsRoutes");

function DeletingCommentsRoutes(){
    register_rest_route("reftreff/v1", "manageComments", array(
        "methods" => "DELETE",
        "callback" => "deleteComment"
    ));
}

function deleteComment($data){
    $commentId = sanitize_text_field($data["commentId"]);

    if(is_user_logged_in()){
        $user = wp_get_current_user();
        if(in_array( 'administrator', (array) $user->roles )){
            wp_delete_comment($commentId, true);
            return "deleting complete";
        }else{
            die("You do not have enough permissions");
        }
    }else{
        die("You need to be logged in to performe this action");
    }
}