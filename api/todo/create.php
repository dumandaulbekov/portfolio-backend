<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->create();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function create() {
        $todo = json_decode(file_get_contents("php://input"));

        if (trim($todo->name === '' && $todo->boardType === '')) {
            return http_response_code(400);
        }

        echo $this->todoService->create($todo->name, $todo->boardType, $todo->scheduleDate);
    }
}
