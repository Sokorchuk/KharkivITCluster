<?php
// controllers/ProductController.php

require_once __DIR__ . '/../models/Product.php';

class ProductController {
    public function list() {
        // Отримати дані від моделі
        $productModel = new Product();
        $products = $productModel->getProducts();

        // Приєднати відображення
        require_once __DIR__ . '/../views/product.php';
    }
}
