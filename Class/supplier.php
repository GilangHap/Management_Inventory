<?php
require_once 'koneksi.php';

class Supplier {
    private $db;

    public function __construct() {
        $this->db = Koneksi::getInstance(); // Menggunakan koneksi dari singleton
    }

    public function getSuppliers() {
        $query = "SELECT * FROM suppliers";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSupplier($name, $contact) {
        $query = "
            INSERT INTO suppliers (name, contact) 
            VALUES (:name, :contact)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':contact', $contact);
        $stmt->execute();
    }

    public function deleteSupplier($id) {
        $query = "DELETE FROM suppliers WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateSupplier($id, $name, $contact) {
        $query = "
            UPDATE suppliers 
            SET name = :name, contact = :contact 
            WHERE id = :id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':contact', $contact);
        $stmt->execute();
    }

    public function getSupplierById($id) {
        $query = "SELECT * FROM suppliers WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>