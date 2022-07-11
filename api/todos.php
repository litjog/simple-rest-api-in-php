<?php

require_once '../controllers/TodosController.php';

try {
  $todosController = new TodosController(true);
  $todosController->handleRequest();
} catch (\Throwable $th) {
  header('Content-Type: application/json');
  http_response_code(500);
  echo json_encode(array(
    'success' => false,
    'message' => $th->getMessage()
  ));
  die();
}

?>
