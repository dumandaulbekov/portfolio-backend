<?php

require '../connect.php';

$create = new CreateTodo();
$create->create();

class CreateTodo {
    public function create() {
        $con = connect();

        $body = file_get_contents("php://input");

        if (isset($body) && !empty($body)) {
            $todo = json_decode($body);

            if (trim($todo->name === '' || $todo->boardType === '')) {
                return http_response_code(400);
            }

            $name = mysqli_real_escape_string($con, trim($todo->name));
            $createdDate = mysqli_real_escape_string($con, $todo->createdDate);
            $modifiedDate = mysqli_real_escape_string($con, $todo->modifiedDate);
            $scheduleDate = mysqli_real_escape_string($con, $todo->scheduleDate);
            $isFinished = mysqli_real_escape_string($con, $todo->isFinished);
            $boardType = mysqli_real_escape_string($con, $todo->boardType);

            $sql = "INSERT INTO `todoist`(`id`, `name`, `createdDate`, `modifiedDate`, `scheduleDate`, `isFinished`, `boardType`) VALUES (null, '{$name}', '{$createdDate}', '{$modifiedDate}', '{$scheduleDate}', '{$isFinished}', '{$boardType}')";

            if (mysqli_query($con, $sql)) {
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
                return http_response_code(422);
            }
        }
    }
}
