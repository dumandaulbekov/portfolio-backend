<?php

require '../service/post.service.php';

$postService = new PostService();
echo $postService->getAll();
