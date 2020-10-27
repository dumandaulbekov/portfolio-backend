<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->updateName();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function updateName() {
        $todo = json_decode(file_get_contents("php://input"));

        if ((int)$todo->id < 0 && trim($todo->name === '')) {
            return  http_response_code(400);
        }

        echo $this->todoService->updateName($todo->id, $todo->name);
    }
}
