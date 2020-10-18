<?php

require '../connect.php';

$request = file_get_contents("php://input");

if (isset($request) && !empty($request)) {
    $body = json_decode($request);

    if (trim($body->name === '' || $body->boardType === '')) {
        return http_response_code(400);
    }

    $name = mysqli_real_escape_string($con, trim($body->name));
    $createdDate = mysqli_real_escape_string($con, $body->createdDate);
    $modifiedDate = mysqli_real_escape_string($con, $body->modifiedDate);
    $scheduleDate = mysqli_real_escape_string($con, $body->scheduleDate);
    $isFinished = mysqli_real_escape_string($con, $body->isFinished);
    $boardType = mysqli_real_escape_string($con, $body->boardType);

    $sql = "INSERT INTO `todoist`(`id`, `name`, `createdDate`, `modifiedDate`, `scheduleDate`, `isFinished`, `boardType`) VALUES (null, '{$name}', '{$createdDate}', '{$modifiedDate}', '{$scheduleDate}', '{$isFinished}', '{$boardType}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);

        $todo = [
            'id' => mysqli_insert_id($con),
            'name' => $name,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate,
            'scheduleDate' => $scheduleDate,
            'isFinished' => $isFinished,
            'boardType' => $boardType,
        ];

        echo json_encode($todo);
    } else {
        http_response_code(422);
    }
}
