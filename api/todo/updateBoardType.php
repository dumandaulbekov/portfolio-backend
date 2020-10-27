<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->updateBoardType();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function updateBoardType() {
        $todo = json_decode(file_get_contents("php://input"));

        if ((int)$todo->id < 0 && trim($todo->boardType === '')) {
            return  http_response_code(400);
        }

        echo $this->todoService->updateBoardType($todo->id, $todo->boardType);
    }
}
