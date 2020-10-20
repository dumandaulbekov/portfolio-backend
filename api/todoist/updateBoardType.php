<?php

require '../connect.php';

$update = new UpdateTodoType();
$update->updateType();

class UpdateTodoType {
    public function updateType() {
        $con = connect();

        $body = file_get_contents("php://input");

        if (isset($body) && !empty($body)) {
            $todo = json_decode($body);

            if ((int)$todo->id < 1 || trim($todo->boardType) == '') {
                return http_response_code(400);
            }

            $id = mysqli_escape_string($con, (int)$todo->id);
            $boardType = mysqli_escape_string($con, $todo->boardType);
            $modifiedDate = mysqli_escape_string($con, $todo->modifiedDate);

            $sql = "UPDATE `todoist` SET `boardType`='$boardType', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo json_encode($result);
            } else {
                return http_response_code(422);
            }
        }
    }
}
