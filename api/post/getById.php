<?php

require "../connect.php";

$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)
    ? mysqli_real_escape_string($con, (int)$_GET['id'])
    : false;

if ($id) {
    $sql = "SELECT * FROM `posts` WHERE id='{$id}'";

    if ($result = mysqli_query($con, $sql)) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else {
        http_response_code(404);
    }
} else {
    return http_response_code(400);
}
