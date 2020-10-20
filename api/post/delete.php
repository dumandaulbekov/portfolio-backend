<?php

require '../connect.php';

$delete = new DeletePost();
$delete->delete();

class DeletePost {
    public function delete() {
        $con = connect();
        $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)
            ? mysqli_real_escape_string($con, (int)$_GET['id'])
            : false;

        if ($id) {
            $sql = "DELETE FROM `posts` WHERE `id` = '{$id}' LIMIT 1";

            if (mysqli_query($con, $sql)) {
                return http_response_code(204);
            } else {
                return http_response_code(422);
            }
        } else {
            return http_response_code(400);
        }
    }
}
