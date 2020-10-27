<?php
require "../connect.php";

class PostService {
    private $con;

    public function __construct() {
        $this->con = connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM posts WHERE isDeleted=false";
        $db_response = $this->con->query($sql);

        $posts = [];

        $i = 0;
        foreach ($db_response as $row) {
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['title'] = $row['title'];
            $posts[$i]['content'] = $row['content'];
            $posts[$i]['createdDate'] = $row['createdDate'];
            $posts[$i]['modifiedDate'] = $row['modifiedDate'];

            $i++;
        }

        return json_encode($posts);
    }

    public function getById($id) {
        $sql = "SELECT * FROM `posts` WHERE id='{$id}'";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response->fetch());
    }

    public function create($title, $content) {
        $createdDate = date('Y-m-d');
        $modifiedDate = date('Y-m-d');

        $sql = "INSERT INTO `posts` (`title`, `content`, `createdDate`, `modifiedDate`) VALUES (:title, :content, :createdDate, :modifiedDate)";
        $db_response = $this->con->prepare($sql)->execute([
            'title' => $title,
            'content' => $content,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate
        ]);

        if (!$db_response) {
            return http_response_code(422);
        }

        $getAdddedPost = $this->getById($this->con->lastInsertId());
        return json_encode($getAdddedPost);
    }

    public function update($id, $title, $content) {
        $modifiedDate = date('Y-m-d');

        $sql = "UPDATE `posts` SET `title`='$title', `content`='$content', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }

    public function delete($id) {
        $modifiedDate = date('Y-m-d');
        $isDeleted = true;

        $sql = "UPDATE `posts` SET `modifiedDate`='$modifiedDate', `isDeleted`=$isDeleted WHERE `id`='{$id}' LIMIT 1";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }
}
