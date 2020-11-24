<?php
namespace App\Models\PostComment;

interface ICommentRepo {
    public static function save_comment($post_id, $comment);

    public static function get_comment($post_id, $comment_id);

    public static function list_post_comment($post_id);

    public static function delete_comment($post_id, $comment_id);

    public static function edit_comment($post_id, $comment_id);

    public static function save_reply_comment($post_id, $comment_id);

    public static function get_reply_comment($post_id, $comment_id, $reply_id);
}

?>
