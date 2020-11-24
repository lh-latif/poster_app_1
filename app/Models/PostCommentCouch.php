<?php
namespace App\Models;

use Requests;
use Exception;
use App\Models\PostComment\Execptions\ConnectionError;

class PostCommentCouch {
    private static $base_url = "http://admin:password@localhost:5984/post_comment";

    public static function add_post_comment($post_id,$user_id) {
        $resp = Requests::post(
            self::$base_url,
            ["Content-Type" => "application/json"],
            json_encode([
                "_id" => $post_id,
                "post_id" => $post_id,
                "user_id" => $user_id,
                "notify_author" => true,
                "accept_comment" => true,
                "last_comment_id" => 0,
                "total_comment" => 0,
                "comments" => []
            ]),
            []
        );
        if ($resp->status_code == 201) {
            try {
                return json_encode($resp->body);
            } catch(Exception $e) {
                throw new Exception("Response body error");
            }
        } else {
            throw new ConnectionError();
        }
    }

    public static function delete_post_comment($post_id) {
        $resp = Requests::delete(
            self::$base_url."/$post_id",
            [],
            []
        );

        if ($resp->status_code == 200) {
            try {
                return json_encode($resp->body);
            } catch (Exception $e) {
                throw new Exception("Response body error");
            }
        } else {
            throw new ConnectionError();
        }
    }

    public static function get_post_comment($post_id) {
        $resp = Requests::get(self::$base_url."/$post_id", [], []);
        if ($resp->status == 200 && isset($resp->body)) {
            $body;
            try {
                $body = json_decode($resp->body);
            } catch (Exception $e) {
                return null;
            }
            return $body;
        } else {
            return null;
        }
    }

    public static function add_comment($post_id, $comment) {
        $comment_data = self::get_comment_data($post_id);
        // var_dump($comment_data);
        if (isset($comment_data) && $comment_data->accept_comment == true) {
            $result = self::add_comment_to_db(
                $post_id,
                json_encode([
                    "comment" => [
                        "user_id" => $comment->user_id,
                        "content" => $comment->content
                    ]
                ])
            );
            return $result;
        } else {
            return Result::error(new EntityNotFound());
        }

    }

    protected static function add_comment_to_db($post_id,$body) {
        $resp = Requests::put(
            self::$base_url."/_design/comment/_update/add_comments/$post_id",
            ["Content-Type" => "application/json"],
            $body,
            []
        );
        if ($resp->status_code == 201) {
            return Result::success($resp->body);
        } else {
            return Result::error(new Exception(null));
        }
    }

    public static function get_comment_data($post_id) {
        $resp = Requests::get(
            self::$base_url."/_design/comment/_show/post_comment_data/$post_id",
            [],
            []
        );
        if ($resp->status_code == 200) {
            try {
                return json_decode($resp->body);
            } catch(Exception $e) {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function edit_comment($post_id,$comment_id) {

    }
}

?>
