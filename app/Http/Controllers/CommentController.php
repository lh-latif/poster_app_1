<?php
namespace App\Http\Controllers;

use App\Models\PostCommentCouch as PostComment;
use App\Models\PostComment\Comment;
use Illuminate\Http\Request;
use App\Models\Exception\EntityNotFound;

class CommentController {
    public static function add_comment(Request $req) {
        $post_id = $req->params("post_id");
        $user = $req->state->user;
        $attrs = $req->validate([
            "content" => ["string","required","min:3"]
        ]);
        $comment = new Comment($post_id, $user->id, $attrs["content"]);
        try {
            $result = PostComment::add_comment($post_id, $comment);
            if ($result->is_success()) {
                return response()->
                    json($result->unwrap());
            } else {
                return response(422, $result->unwrap()->getMessage());
            }
        } catch (EntityNotFound $e) {
            return response(404,"Entity Not Found");
        }
    }

    public static function edit_comment(Request $req) {
        $post_id = $req->params("");
    }

    public static function delete(Request $req) {
        $attrs = $req->validate([
            "post_id" => ["required"],
            "comment_id" => ["required"]
        ]);

        $result = PostCommnet::delete_comment(
            $attrs["post_id"],
            $attrs["user_id"],
            $attrs["comment_id"]
        );
    }
}

?>
