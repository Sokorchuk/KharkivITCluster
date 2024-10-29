<?php

require_once __DIR__ . '/../Database.php';

class CustomerController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllCustomers() {
        $stmt = $this->db->query("SELECT * FROM Customer");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Customer WHERE customer_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCustomer($data) {
        $stmt = $this->db->prepare("INSERT INTO Customer (name, email, phone) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['email'], $data['phone']]);
        return $this->getCustomerById($this->db->lastInsertId());
    }

    public function updateCustomer($id, $data) {
        $stmt = $this->db->prepare("UPDATE Customer SET name = ?, email = ?, phone = ? WHERE customer_id = ?");
        $stmt->execute([$data['name'], $data['email'], $data['phone'], $id]);
        return $this->getCustomerById($id);
    }

    public function deleteCustomer($id) {
        $stmt = $this->db->prepare("DELETE FROM Customer WHERE customer_id = ?");
        $stmt->execute([$id]);
    }
}
