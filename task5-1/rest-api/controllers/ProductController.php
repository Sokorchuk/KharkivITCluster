<?php

require_once __DIR__ . '/../Database.php';

class ProductController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllProducts() {
        $stmt = $this->db->query("SELECT * FROM Product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Product WHERE product_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($data) {
        $stmt = $this->db->prepare("INSERT INTO Product (name, price, stock_quantity) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['price'], $data['stock_quantity']]);
        return $this->getProductById($this->db->lastInsertId());
    }

    public function updateProduct($id, $data) {
        $stmt = $this->db->prepare("UPDATE Product SET name = ?, price = ?, stock_quantity = ? WHERE product_id = ?");
        $stmt->execute([$data['name'], $data['price'], $data['stock_quantity'], $id]);
        return $this->getProductById($id);
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM Product WHERE product_id = ?");
        $stmt->execute([$id]);
    }
}
