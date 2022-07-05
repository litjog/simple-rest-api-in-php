<?php

require_once 'config.php';

class Connection {
  protected $pdo = null;

  public function connect() {
    try {
      $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ));
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function close() {
    $this->pdo = null;
  }
}

?>
