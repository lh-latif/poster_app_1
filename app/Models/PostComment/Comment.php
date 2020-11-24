<?php
namespace App\Models\PostComment;

use App\Models\Comment\Reply;

class Comment {
    public $post_id,
            $user_id,
            $content,
            $replies,
            $acceptReply;

    public function __construct($post_id, $user_id, $content) {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->content = $content;
    }

    public function to_json() {
        return json_encode([
            "user_id" => $this->user_id,
            "content" => $this->content
        ]);
    }
}
?>
