<?php

require '../service/post.service.php';

$post = new Post();
$post->create();

class Post {
    private $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function create() {
        $post = json_decode(file_get_contents("php://input"));

        if (trim($post->title === '' && $post->content === '')) {
            return http_response_code(400);
        }

        echo $this->postService->create($post->title, $post->content);
    }
}
