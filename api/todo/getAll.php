<?php

require '../service/todo.service.php';

$todoService = new TodoService();
echo $todoService->getAll();