<?php
// routes.php

// Простий роутер для прикладу
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/products':
        require __DIR__ . '/controllers/ProductController.php';
        $controller = new ProductController();
        $controller->list();
        break;
    default:
        echo "404 - Page Not Found";
        break;
}
