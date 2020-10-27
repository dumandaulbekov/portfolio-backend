<?php

require '../service/post.service.php';

$post = new Post();
$post->update();

class Post {
    private $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function update() {
        $post = json_decode(file_get_contents("php://input"));

        if ((int)$post->id < 1 && trim($post->title === '' && $post->content === '')) {
            return http_response_code(400);
        }

        echo $this->postService->update($post->id, $post->title, $post->content);
    }
}
