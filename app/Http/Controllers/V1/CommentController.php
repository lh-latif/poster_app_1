<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\PostComment\Comment;
use App\Models\Exceptions\EntityNotFound;
use App\Models\PostCommentCouch as PostComment;

class CommentController {
    public static function add(Request $req) {
        $attrs = $req->validate([
            "post_id" => ["string","uuid"],
            "content" => ["string","required","min:3"]
        ]);
        $user = $req->user;
        $comment = new Comment($attrs["post_id"], $user->id, $attrs["content"]);
        try {
            $result = PostComment::add_comment($attrs["post_id"], $comment);
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

    public static function edit(Request $req) {

    }
}

?>
