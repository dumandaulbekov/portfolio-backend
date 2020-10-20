<?php
require '../connect.php';

$create = new CreatePost();
$create->create();

class CreatePost {
    public function create() {
        $con = connect();

        $body = file_get_contents("php://input");

        if (isset($body) && !empty($body)) {
            $post = json_decode($body);

            if (trim($post->title === '' || $post->content === '')) {
                return http_response_code(400);
            }

            $title = mysqli_real_escape_string($con, trim($post->title));
            $content = mysqli_real_escape_string($con, trim($post->content));
            $createdDate = mysqli_real_escape_string($con, $post->createdDate);
            $modifiedDate = mysqli_real_escape_string($con, $post->modifiedDate);

            $sql = "INSERT INTO `posts`(`id`, `title`, `content`, `createdDate`, `modifiedDate`) VALUES (null, '{$title}', '{$content}', '{$createdDate}' ,'{$modifiedDate}')";

            if (mysqli_query($con, $sql)) {
                http_response_code(201);

                $post = [
                    'id' => mysqli_insert_id($con),
                    'title' => $title,
                    'content' => $content,
                    'createdDate' => $createdDate,
                    'modifiedDate' => $modifiedDate,
                ];

                echo json_encode($post);
            } else {
                return http_response_code(422);
            }
        }
    }
}
