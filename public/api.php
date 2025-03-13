<?php

global $pageUrl;

header('Content-Type: application/json');

require __DIR__.'/../vendor/autoload.php';

$apiResourceClass = 'App\\Api\\' . ucfirst(basename($pageUrl));
if (!class_exists($apiResourceClass)) {
    http_response_code(404);
    echo json_encode(['error' => 'API resource not found']);
    exit;
}

// Handle API method request and response
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        (new $apiResourceClass())->postData();
        http_response_code(201);
        break;
    case 'GET':
        $data = (new $apiResourceClass())->getData();
        http_response_code(200);
        echo json_encode(['data' => $data]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'API resource method not allowed']);
}
