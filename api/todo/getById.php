<?php

require '../service/todo.service.php';

$todo = new Todo();
$todo->getById();

class Todo {
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function getById() {
        $id = $_GET['id'];

        if (!$id && $id < 0) {
            return http_response_code(400);
        }

        echo $this->todoService->getById($id);
    }
}
