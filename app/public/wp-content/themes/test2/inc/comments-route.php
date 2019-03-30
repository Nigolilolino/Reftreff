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
        $permission = array("administrator","leiter" ,"subscriber");
        if(count(array_intersect($permission, $user->roles)) > 0){
            wp_delete_comment($commentId, true);
            return "deleting complete";
        }else{
            die("You do not have enough permissions");
        }
    }else{
        die("You need to be logged in to performe this action");
    }
}