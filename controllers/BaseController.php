<?php

class BaseController {
  public function __construct() {}

  protected function cors() {
    $allowedMethods = array('OPTIONS', 'HEAD', 'POST', 'GET', 'PUT', 'PATCH', 'DELETE');
  
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: '.implode(', ', $allowedMethods));
    header('Accept: application/json');
  
    if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
      $this->failedResponse(405, 'Method not allowed');
      die();
    }
  
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(204);
      die();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
      http_response_code(200);
      die();
    }
  }

  protected function successResponse($code, $data = array(), $message = '') {
    header('Content-Type: application/json');

    $response = array('success' => true);
    if ($data) $response['data'] = $data;
    if ($message) $response['message'] = $message;

    http_response_code($code);
    echo json_encode($response);
  }

  protected function failedResponse($code, $message = '') {
    header('Content-Type: application/json');
    
    $response = array('success' => false);
    if ($message) $response['message'] = $message;

    http_response_code($code);
    echo json_encode($response);
  }
}

?>