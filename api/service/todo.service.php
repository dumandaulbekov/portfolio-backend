<?php

require "../connect.php";

class TodoService {
    private $con;

    public function __construct() {
        $this->con = connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM todoist WHERE isFinished=false AND isDeleted=false";
        $db_response = $this->con->query($sql);

        $todos = [];

        $i = 0;
        foreach ($db_response as $row) {
            $todos[$i]['id'] = $row['id'];
            $todos[$i]['name'] = $row['name'];
            $todos[$i]['createdDate'] = $row['createdDate'];
            $todos[$i]['modifiedDate'] = $row['modifiedDate'];
            $todos[$i]['scheduleDate'] = $row['scheduleDate'];
            $todos[$i]['isFinished'] = $row['isFinished'];
            $todos[$i]['boardType'] = $row['boardType'];

            $i++;
        }

        return json_encode($todos);
    }

    public function getById($id) {
        $sql = "SELECT * FROM `todoist` WHERE id='{$id}'";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response->fetch());
    }

    public function create($name, $boardType, $scheduleDate) {
        $createdDate = date('Y-m-d');
        $modifiedDate = date('Y-m-d');

        $sql = "INSERT INTO `todoist`(`name`, `createdDate`, `modifiedDate`, `scheduleDate`, `boardType`) VALUES (:name, :createdDate, :modifiedDate, :scheduleDate, :boardType)";
        $db_response = $this->con->prepare($sql)->execute([
            'name' => $name,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate,
            'scheduleDate' => $scheduleDate,
            'boardType' => $boardType
        ]);

        if (!$db_response) {
            return http_response_code(422);
        }

        $getAdddedTodo = $this->getById($this->con->lastInsertId());
        return json_encode($getAdddedTodo);
    }

    public function updateName($id, $name) {
        $modifiedDate = date('Y-m-d');

        $sql = "UPDATE `todoist` SET `name`='$name', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }

    public function updateBoardType($id, $boardType) {
        $modifiedDate = date('Y-m-d');

        $sql = "UPDATE `todoist` SET `boardType`='$boardType', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }

    public function isFinished($id) {
        $modifiedDate = date('Y-m-d');
        $isFinished = true;

        $sql = "UPDATE `todoist` SET `isFinished`='$isFinished', `modifiedDate`='$modifiedDate' WHERE `id`='{$id}' LIMIT 1";

        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }

    public function delete($id) {
        $modifiedDate = date('Y-m-d');
        $isDeleted = true;

        $sql = "UPDATE `todoist` SET `modifiedDate`='$modifiedDate', `isDeleted`=$isDeleted WHERE `id`='{$id}' LIMIT 1";
        $db_response = $this->con->query($sql);

        if (!$db_response) {
            return http_response_code(422);
        }

        return json_encode($db_response);
    }
}
