<?php
// models/Product.php

class Product {
    // Зімітувати отримання даних про товари
    public function getProducts() {
        return [
            ['name' => 'Компʼютер', 'price' => 14000],
            ['name' => 'Смартфон', 'price' => 3500],
            ['name' => 'Планшет', 'price' => 1300]
        ];
    }
}
