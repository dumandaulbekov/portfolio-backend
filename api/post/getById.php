<?php

require '../service/post.service.php';

$post = new Post();
$post->getById();

class Post {
    private $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function getById() {
        $id = $_GET['id'];

        if (!$id && $id < 0) {
            return http_response_code(400);
        }

        echo $this->postService->getById($id);
    }
}
