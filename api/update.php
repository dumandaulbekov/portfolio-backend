<?php

require 'connect.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if ((int)$request->id < 1 || trim($request->title) == '' || trim($request->content) == '') {
        return http_response_code(400);
    }

    $id = mysqli_escape_string($con, (int)$request->id);
    $title = mysqli_escape_string($con, trim($request->title));
    $content = mysqli_escape_string($con, trim($request->content));
    $modifiedDate = mysqli_real_escape_string($con, $request->modifiedDate);

    $sql = "UPDATE `posts` SET `title`='$title', `content`='$content', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";

    if (mysqli_query($con, $sql)) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}
