<?php

require_once '../cors.php';
require_once '../models/Todos.php';

$response = null;
$todos = new Todos();

function format_todo($todo) {
  return array(
    'id' => (int)$todo['id'],
    'body' => $todo['body'],
    'hasCompleted' => $todo['has_completed'] === '1',
    'createdAt' => $todo['created_at'],
    'updatedAt' => $todo['updated_at'],
  );
}

function map_todo($todos) {
  return array_map('format_todo', $todos);
}

try {
  switch ($request_method) {
    case 'POST':
      $request_body = json_decode(file_get_contents('php://input'), true);
      $body = $request_body['body'];
      $lastInsertId = $todos->addTodo($body);
      $newTodo = $todos->getTodo($lastInsertId);
      $response = array(
        'success' => true,
        'todo' => format_todo($newTodo)
      );
      http_response_code(201);
      break;
    case 'PUT':
      if (!isset($_GET['id']) || $_GET['id'] === '') {
        $response = array(
          'success' => false,
          'Message' => 'Id not specified'
        );
        http_response_code(400);
      } else {
        $id = (int)$_GET['id'];
        $todo = $todos->getTodo($id);
        if (!$todo) {
          $response = array(
            'success' => false,
            'message' => 'Todo not found'
          );
          http_response_code(404);
        } else {
          $request_body = json_decode(file_get_contents('php://input'), true);
          $body = $request_body['body'];
          $has_completed = $request_body['hasCompleted'] === true ? 1 : 0;
          $todos->updateTodo($id, $body, $has_completed);
          $updatedTodo = $todos->getTodo($id);
          $response = array(
            'success' => true,
            'todo' => format_todo($updatedTodo)
          );
          http_response_code(200);
        }
      }
      break;
    case 'PATCH':
      if (!isset($_GET['id']) || $_GET['id'] === '') {
        $response = array(
          'success' => false,
          'Message' => 'Id not specified'
        );
        http_response_code(400);
      } else {
        $id = (int)$_GET['id'];
        $todo = $todos->getTodo($id);
        if (!$todo) {
          $response = array(
            'success' => false,
            'message' => 'Todo not found'
          );
          http_response_code(404);
        } else {
          $request_body = json_decode(file_get_contents('php://input'), true);
          $has_completed = $request_body['hasCompleted'] === true ? 1 : 0;
          $todos->toggleTodo($id, $has_completed);
          $updatedTodo = $todos->getTodo($id);
          $response = array(
            'success' => true,
            'todo' => format_todo($updatedTodo)
          );
          http_response_code(200);
        }
      }
      break;
    case 'DELETE':
      if (!isset($_GET['id']) || $_GET['id'] === '') {
        $response = array(
          'success' => false,
          'Message' => 'Id not specified'
        );
        http_response_code(400);
      } else {
        $id = (int)$_GET['id'];
        $todo = $todos->getTodo($id);
        if (!$todo) {
          $response = array(
            'success' => false,
            'message' => 'Todo not found'
          );
          http_response_code(404);
        } else {
          $todos->deleteTodo($id);
          $response = array(
            'success' => true,
            'message' => 'Todo deleted'
          );
          http_response_code(200);
        }
      }
      break;
    // Default to HTTP GET method
    default:
      if (!isset($_GET['id']) || $_GET['id'] === '') {
        $response = array(
          'success' => true,
          'todos' => map_todo($todos->getTodos())
        );
        http_response_code(200);
      } else {
        $todo = $todos->getTodo((int)$_GET['id']);
        if (!$todo) {
          $response = array(
            'success' => false,
            'message' => 'Todo not found'
          );
          http_response_code(404);
        } else {
          $response = array(
            'success' => true,
            'todo' => format_todo($todo)
          );
          http_response_code(200);
        }
      }
      break;
  }
} catch (\Exception $e) {
  $response = array(
    'success' => false,
    'message' => $e->getMessage()
  );
  http_response_code(500);
} finally {
  $todos->close();
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

?>
