<?php

require '../connect.php';

$sql = "SELECT * FROM `todoist` WHERE `isFinished` = 0";

if ($result = mysqli_query($con, $sql)) {
    $todoist = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $todoist[$i]['id'] = $row['id'];
        $todoist[$i]['name'] = $row['name'];
        $todoist[$i]['createdDate'] = $row['createdDate'];
        $todoist[$i]['modifiedDate'] = $row['modifiedDate'];
        $todoist[$i]['scheduleDate'] = $row['scheduleDate'];
        $todoist[$i]['isFinished'] = $row['isFinished'];
        $todoist[$i]['boardType'] = $row['boardType'];

        $i++;
    };

    echo json_encode($todoist);
} else {
    return http_response_code(404);
}
