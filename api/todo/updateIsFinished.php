<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->delete();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function isFinished() {
        $todo = json_decode(file_get_contents("php://input"));

        if (!$todo->id && $todo->id < 0) {
            return http_response_code(400);
        }

        echo $this->todoService->delete($todo->id);
    }
}
