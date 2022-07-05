<?php

$request_method = $_SERVER['REQUEST_METHOD'];
$allowed_methods = array('OPTIONS', 'HEAD', 'POST', 'GET', 'PUT', 'PATCH', 'DELETE');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: '.implode(', ', $allowed_methods));
header('Accept: application/json');
header('Content-Type: application/json');

if (!in_array($request_method, $allowed_methods)) {
  $response = array(
    'success' => false,
    'message' => 'Method not allowed'
  );
  http_response_code(405);
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

if ($request_method === 'OPTIONS') {
  http_response_code(204);
  die();
}

if ($request_method === 'HEAD') {
  http_response_code(200);
  die();
}

?>
