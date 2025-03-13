<?php
require_once 'koneksi.php';

class Inventaris {
    private $db;

    public function __construct() {
        $this->db = Koneksi::getInstance(); // Menggunakan koneksi dari singleton
    }

    public function getInventoryItems() {
        $query = "
            SELECT inventory_items.*, suppliers.name AS supplier 
            FROM inventory_items 
            LEFT JOIN suppliers ON inventory_items.supplier_id = suppliers.id
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addInventoryItem($name, $quantity, $price, $supplier_id) {
        $query = "
            INSERT INTO inventory_items (name, quantity, price, supplier_id) 
            VALUES (:name, :quantity, :price, :supplier_id)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->execute();

        // Log the addition of new inventory
        $item_id = $this->db->lastInsertId();
        $this->logInventoryChange($item_id, $quantity);
    }

    public function deleteInventoryItem($id) {
        $query = "DELETE FROM inventory_items WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateInventoryItem($id, $name, $quantity, $price, $supplier_id) {
        $query = "
            UPDATE inventory_items 
            SET name = :name, quantity = :quantity, price = :price, supplier_id = :supplier_id 
            WHERE id = :id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->execute();
    }

    public function getInventoryItemById($id) {
        $query = "SELECT * FROM inventory_items WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInventoryItemByName($name) {
        $query = "SELECT * FROM inventory_items WHERE name = :name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInventoryItemQuantity($id, $new_quantity) {
        // Get the current quantity
        $currentItem = $this->getInventoryItemById($id);
        $current_quantity = $currentItem['quantity'];

        // Calculate the change in quantity
        $change_quantity = $new_quantity - $current_quantity;

        // Update the quantity
        $query = "UPDATE inventory_items SET quantity = :quantity WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':quantity', $new_quantity);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Log the change in inventory
        $this->logInventoryChange($id, $change_quantity);
    }

    public function logInventoryChange($item_id, $change_quantity) {
        $change_date = date('Y-m-d H:i:s');
        $query = "INSERT INTO inventory_log (item_id, change_quantity, change_date) VALUES (:item_id, :change_quantity, :change_date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->bindParam(':change_quantity', $change_quantity);
        $stmt->bindParam(':change_date', $change_date);
        $stmt->execute();
    }

    public function getInventoryLog() {
        $query = "SELECT il.id, i.name, il.change_quantity, il.change_date 
                  FROM inventory_log il 
                  JOIN inventory_items i ON il.item_id = i.id 
                  ORDER BY il.change_date DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
