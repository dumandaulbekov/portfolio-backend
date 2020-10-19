<?php

require '../connect.php';

$request = file_get_contents("php://input");

if (isset($request) && !empty($request)) {
    $post = json_decode($request);

    if ((int)$post->id < 1 || trim($post->title) == '' || trim($post->content) == '') {
        return http_response_code(400);
    }

    $id = mysqli_escape_string($con, (int)$post->id);
    $title = mysqli_escape_string($con, trim($post->title));
    $content = mysqli_escape_string($con, trim($post->content));
    $modifiedDate = mysqli_real_escape_string($con, $post->modifiedDate);

    $sql = "UPDATE `posts` SET `title`='$title', `content`='$content', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";

    if (mysqli_query($con, $sql)) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}
