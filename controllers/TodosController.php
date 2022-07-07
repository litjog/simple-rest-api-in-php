<?php

require_once 'BaseController.php';
require_once '../models/Todos.php';

class TodosController extends BaseController {
  private $allowCors;
  private $todos;

  public function __construct($allowCors = false) {
    $this->allowCors = $allowCors;
    $this->todos = new Todos();
  }

  public function handleRequest() {
    try {
      if ($this->allowCors) {
        $this->cors();
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->post();
        return;
      }
  
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $this->get();
        return;
      }
  
      if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $this->put();
        return;
      }

      if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
        $this->patch();
        return;
      }
  
      if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $this->delete();
        return;
      }
    } catch (\Throwable $th) {
      $this->failedResponse(500, $th->getMessage());
    } finally {
      $this->todos->close();
      die();
    }
  }

  private function post() {
    $requestBody = json_decode(file_get_contents('php://input'), true);
    $body = $requestBody['body'];
    $lastInsertId = $this->todos->addTodo($body);
    $newTodo = $this->todos->getTodo($lastInsertId);
    $this->successResponse(201, $this->formatTodo($newTodo));
  }

  private function get() {
    if (!isset($_GET['id']) || $_GET['id'] === '') {
      $this->successResponse(200, $this->mapTodo($this->todos->getTodos()));
    } else {
      $todo = $this->todos->getTodo((int)$_GET['id']);
      if (!$todo) {
        $this->failedResponse(404, 'Todo not found');
      } else {
        $this->successResponse(200, $this->formatTodo($todo));
      }
    }
  }

  private function put() {
    if (!isset($_GET['id']) || $_GET['id'] === '') {
      $this->failedResponse(400, 'Id not specified');
    } else {
      $id = (int)$_GET['id'];
      $todo = $this->todos->getTodo($id);
      if (!$todo) {
        $this->failedResponse(404, 'Todo not found');
      } else {
        $requestBody = json_decode(file_get_contents('php://input'), true);
        $body = $requestBody['body'];
        $hasCompleted = $requestBody['hasCompleted'] === true ? 1 : 0;
        $this->todos->updateTodo($id, $body, $hasCompleted);
        $updatedTodo = $this->todos->getTodo($id);
        $this->successResponse(200, $this->formatTodo($updatedTodo));
      }
    }
  }

  private function patch() {
    if (!isset($_GET['id']) || $_GET['id'] === '') {
      $this->failedResponse(400, 'Id not specified');
    } else {
      $id = (int)$_GET['id'];
      $todo = $this->todos->getTodo($id);
      if (!$todo) {
        $this->failedResponse(404, 'Todo not found');
      } else {
        $requestBody = json_decode(file_get_contents('php://input'), true);
        $hasCompleted = $requestBody['hasCompleted'] === true ? 1 : 0;
        $this->todos->toggleTodo($id, $hasCompleted);
        $updatedTodo = $this->todos->getTodo($id);
        $this->successResponse(200, $this->formatTodo($updatedTodo));
      }
    }
  }

  private function delete() {
    if (!isset($_GET['id']) || $_GET['id'] === '') {
      $this->failedResponse(400, 'Id not specified');
    } else {
      $id = (int)$_GET['id'];
      $todo = $this->todos->getTodo($id);
      if (!$todo) {
        $this->failedResponse(404, 'Todo not found');
      } else {
        $this->todos->deleteTodo($id);
        $this->successResponse(200, NULL, 'Todo deleted');
      }
    }
  }

  private function formatTodo($todo) {
    return array(
      'id' => (int)$todo['id'],
      'body' => $todo['body'],
      'hasCompleted' => $todo['has_completed'] === '1',
      'createdAt' => $todo['created_at'],
      'updatedAt' => $todo['updated_at'],
    );
  }

  private function mapTodo($todos) {
    return array_map(array($this, 'formatTodo'), $todos);
  }
}

?>