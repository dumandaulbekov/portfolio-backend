<?php

require 'connect.php';

$posts = [];
$sql = "SELECT id, title, content, createdDate, modifiedDate FROM posts";

if ($result = mysqli_query($con, $sql)) {
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $posts[$i]['id'] = $row['id'];
        $posts[$i]['title'] = $row['title'];
        $posts[$i]['content'] = $row['content'];
        $posts[$i]['createdDate'] = $row['createdDate'];
        $posts[$i]['modifiedDate'] = $row['modifiedDate'];

        $i++;
    }

    echo json_encode($posts);
} else {
    http_response_code(404);
}
