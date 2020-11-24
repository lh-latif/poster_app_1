<?php
namespace App;

use App\ArangoDB;

use App\Models\Comment\ICommentRepo;

class CommentRepo implements ICommentRepo  {
    public static function save_comment($post_id, $comment) {
        $cursor = ArangoDB::query([
            "query" =>
                "
                LET data = DOCUMENT(\"post_comment/@post_id\")
                UPDATE data WITH {
                    total_comment: data.total_comment + 1,
                    comments: PUSH(data.comments, @comment)
                }
                RETURN @comment
                "
            "bindVars" => [
                "post_id" => $post_id,
                "comment" => $comment
            ]
        ]);
    }

    public static function get_comment($post_id, $comment_id) {
        $cursor = ArangoDB::query([
            "query" =>
                "
                LET data = DOCUMENT(\"post_comment/@post_id\")
                FOR comment in data.comments
                    SEARCH comment.id == @comment_id LIMIT 1
                RETURN comment;
                ",
            "bindVars" => [
                "post_id" => $post_id,
                "comment_id" => $comment_id
            ]
        ]);
    }


    public static function add_comment($post_id, $comment) {
        return self::save_comment($post_id, $comment);
    }

    public static function list_post_comment($post_id) {

    }
}

class RepoResult {
    protected $result,$values,$exception;


    protected __construct($_result, $_values, $_exception) {
        $result = $_result;
        $values = $_values;
        $exception = $_exception;
    }

    public function to_boolean() {
        return $result;
    }

    public function get_exception() {
        return $execption;
    }

    public static function success($values) {
        return new self(true, $values, null);
    }

    public static function error($error) {
        return new self(false, null, $error);
    }
}
