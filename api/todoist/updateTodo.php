<?php

require '../connect.php';

$request = file_get_contents("php://input");

if (isset($request) && !empty($request)) {
    $todo = json_decode($request);

    if ((int)$todo->id < 1 || trim($todo->name) == '') {
        return http_response_code(400);
    }

    $id = mysqli_escape_string($con, (int)$todo->id);
    $name = mysqli_escape_string($con, trim($todo->name));
    $modifiedDate = mysqli_escape_string($con, $todo->modifiedDate);

    $sql = "UPDATE `todoist` SET `name`='$name', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo json_encode($result);
    } else {
        return http_response_code(422);
    }
}
