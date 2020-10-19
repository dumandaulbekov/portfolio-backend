<?php

require '../connect.php';

$request = file_get_contents("php://input");

if (isset($request) && !empty($request)) {
    $post = json_decode($request);

    if (trim($body->title === '' || $body->content === '')) {
        return http_response_code(400);
    }

    $title = mysqli_real_escape_string($con, trim($post->title));
    $content = mysqli_real_escape_string($con, trim($post->content));
    $createdDate = mysqli_real_escape_string($con, $post->createdDate);
    $modifiedDate = mysqli_real_escape_string($con, $post->modifiedDate);

    $sql = "INSERT INTO `posts`(`id`, `title`, `content`, `createdDate`, `modifiedDate`) VALUES (null, '{$title}', '{$content}', '{$createdDate}' ,'{$modifiedDate}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);

        $post = [
            'id' => mysqli_insert_id($con),
            'title' => $title,
            'content' => $content,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate,
        ];

        echo json_encode($post);
    } else {
        http_response_code(422);
    }
}
