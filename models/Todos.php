<?php

require_once '../connection.php';

class Todos extends Connection  {
  public function __construct() {
   $this->connect();
  }

  public function addTodo($body) {
    try {
      $stmt = $this->pdo->prepare('INSERT INTO todos (body) VALUES (:body);');
      $stmt->execute(array(':body' => $body));
      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function getTodos() {
    try {
      $stmt = $this->pdo->prepare('SELECT * FROM todos;');
      $stmt->execute();
      $rows = $stmt->fetchAll();
      return $rows;
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function getTodo($id) {
    try {
      $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE id = :id;');
      $stmt->execute(array(':id' => $id));
      $row = $stmt->fetch();
      return $row;
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function updateTodo($id, $body, $has_completed) {
    try {
      $stmt = $this->pdo->prepare('UPDATE todos SET body = :body, has_completed = :has_completed WHERE id = :id;');
      $stmt->execute(array(
        ':body' => $body,
        ':has_completed' => $has_completed,
        ':id' => $id
      ));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function toggleTodo($id, $has_completed) {
    try {
      $stmt = $this->pdo->prepare('UPDATE todos SET has_completed = :has_completed WHERE id = :id;');
      $stmt->execute(array(
        ':has_completed' => $has_completed,
        ':id' => $id
      ));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function deleteTodo($id) {
    try {
      $stmt = $this->pdo->prepare('DELETE FROM todos WHERE id = :id;');
      $stmt->execute(array(':id' => $id));
      return $stmt->rowCount();
    } catch (PDOException $e) {
      throw $e;
    }
  }
}

?>
