<?php

require '../service/post.service.php';

$post = new Post();
$post->delete();

class Post {
    private $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function delete() {
        $postId = json_decode(file_get_contents("php://input"));

        if ($postId && $postId < 0) {
            return http_response_code(400);
        }

        echo $this->postService->delete($postId);
    }
}
