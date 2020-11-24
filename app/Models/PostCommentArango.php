<?php
namespace App\Models;

class PostComment {
    public static setRepo() {

    }
    public static function add_comment($post_id) {
        $post_comment_data = $repo::get_post_comment_data($post_id);
        if ($post_comment_data->is_accept_comment()) {
            $repo::add_post_comment($post_id);
        } else {
            throw new Exception("It not accepting comment");
        }

    }

    public static function add_comment_reply($post_id,$comment_id,Reply $reply) {
        $result = $repo::get_comment($post_id,$comment_id);
        if ($result->toBoolean()) {
            $comment = $result->value();
        } else {
            throw new Exception("error");
        }

        if ($comment->is_accept_reply()) {

        } else {
            throw new Exception("It not accepting comment");
        }
    }

    
}

?>
