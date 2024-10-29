<?php

require_once __DIR__ . '/../Database.php';

class OrderController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllOrders() {
        $stmt = $this->db->query("SELECT * FROM Order");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Order WHERE order_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createOrder($data) {
        $stmt = $this->db->prepare("INSERT INTO Order (customer_id, order_date, total_amount) VALUES (?, ?, ?)");
        $stmt->execute([$data['customer_id'], $data['order_date'], $data['total_amount']]);
        return $this->getOrderById($this->db->lastInsertId());
    }

    public function updateOrder($id, $data) {
        $stmt = $this->db->prepare("UPDATE Order SET customer_id = ?, order_date = ?, total_amount = ? WHERE order_id = ?");
        $stmt->execute([$data['customer_id'], $data['order_date'], $data['total_amount'], $id]);
        return $this->getOrderById($id);
    }

    public function deleteOrder($id) {
        $stmt = $this->db->prepare("DELETE FROM Order WHERE order_id = ?");
        $stmt->execute([$id]);
    }
}
