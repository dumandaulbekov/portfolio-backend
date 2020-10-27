<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->delete();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function delete() {
        $todoId = json_decode(file_get_contents("php://input"));

        if (!$todoId && $todoId < 0) {
            return http_response_code(400);
        }

        echo $this->todoService->delete($todoId);
    }
}
