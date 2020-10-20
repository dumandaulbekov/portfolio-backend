<?php

require '../connect.php';

$getById = new GetByIdTodo();
$getById->getById();

class GetByIdTodo {
    public function getById() {
        $con = connect();

        $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)
            ? mysqli_real_escape_string($con, (int)$_GET['id'])
            : false;

        if ($id) {
            $sql = "SELECT * FROM `todoist` WHERE id='{$id}'";

            if ($result = mysqli_query($con, $sql)) {
                return json_encode(mysqli_fetch_assoc($result));
            } else {
                return http_response_code(404);
            }
        } else {
            return http_response_code(400);
        }
    }
}
