<?php

require_once 'DB.php';

class Todos extends DB  {
  public function __construct() {
    $this->connect();
  }

  public function addTodo($body) {
    try {
      $stmt = $this->pdo->prepare('INSERT INTO todos (body) VALUES (:body);');
      $stmt->execute(array(':body' => $body));
      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function getTodos() {
    try {
      $stmt = $this->pdo->prepare('SELECT * FROM todos;');
      $stmt->execute();
      $rows = $stmt->fetchAll();
      return $rows;
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function getTodo($id) {
    try {
      $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE id = :id;');
      $stmt->execute(array(':id' => $id));
      $row = $stmt->fetch();
      return $row;
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function updateTodo($id, $body, $hasCompleted) {
    try {
      $stmt = $this->pdo->prepare('UPDATE todos SET body = :body, has_completed = :has_completed WHERE id = :id;');
      $stmt->execute(array(
        ':body' => $body,
        ':has_completed' => $hasCompleted,
        ':id' => $id
      ));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function toggleTodo($id, $hasCompleted) {
    try {
      $stmt = $this->pdo->prepare('UPDATE todos SET has_completed = :has_completed WHERE id = :id;');
      $stmt->execute(array(
        ':has_completed' => $hasCompleted,
        ':id' => $id
      ));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function deleteTodo($id) {
    try {
      $stmt = $this->pdo->prepare('DELETE FROM todos WHERE id = :id;');
      $stmt->execute(array(':id' => $id));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }
}

?>
