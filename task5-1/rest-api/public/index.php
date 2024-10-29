<?php

require_once __DIR__ . '/../controllers/CustomerController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

switch ($path) {
    case '/customers':
        $controller = new CustomerController();
        handleRequest($method, $controller, $data);
        break;
    case '/orders':
        $controller = new OrderController();
        handleRequest($method, $controller, $data);
        break;
    case '/products':
        $controller = new ProductController();
        handleRequest($method, $controller, $data);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        break;
}

function handleRequest($method, $controller, $data) {
    switch ($method) {
        case 'GET':
            echo json_encode($controller->getAllCustomers());
            break;
        case 'POST':
            echo json_encode($controller->createCustomer($data));
            break;
        case 'PUT':
            echo json_encode($controller->updateCustomer($data['id'], $data));
            break;
        case 'DELETE':
            $controller->deleteCustomer($data['id']);
            echo json_encode(['message' => 'Deleted']);
            break;
    }
}
