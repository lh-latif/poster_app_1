<?php
namespace App\Http\Controllers;

class PostCommentController {
    public static function index($post_id) {
        $post_comment = PostComment::get_post_comment($post_id);
        if (isset($post_comment)) {
            return response()
                ->json($post_comment);
        } else {
            return response(404, "Not Found");
        }
    }
}

?>
