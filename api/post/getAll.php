<?php

require '../connect.php';

$getAll = new GetAllPost();
$getAll->getAll();

class GetAllPost {
    public function getAll() {
        $sql = "SELECT * FROM posts";
        $con = connect();

        if ($result = mysqli_query($con, $sql)) {
            $posts = [];
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
            return json_encode($posts);
        } else {
            return http_response_code(404);
        }
    }
}
