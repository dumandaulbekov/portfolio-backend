<?php

require 'connect.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (trim($request->title === '' || $request->content === '')) {
        return http_response_code(400);
    }

    $title = mysqli_real_escape_string($con, trim($request->title));
    $content = mysqli_real_escape_string($con, trim($request->content));
    $createdDate = mysqli_real_escape_string($con, $request->createdDate);
    $modifiedDate = mysqli_real_escape_string($con, $request->modifiedDate);

    $sql = "INSERT INTO `posts`(`id`, `title`, `content`, `createdDate`, `modifiedDate`) VALUES (null, '{$title}', '{$content}', '{$createdDate}' ,'{$modifiedDate}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);

        $post = [
            'title' => $title,
            'content' => $content,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate,
            'id' => mysqli_insert_id($con),
        ];

        echo json_encode($post);
    } else {
        http_response_code(422);
    }
}
