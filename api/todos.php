<?php

require_once '../controllers/TodosController.php';

$todosController = new TodosController(true);
$todosController->handleRequest();

?>
