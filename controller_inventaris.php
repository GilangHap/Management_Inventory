<?php
require_once 'Class/inventaris.php';

$inventaris = new Inventaris();

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];
    $inventaris->updateInventoryItem($id, $name, $quantity, $price, $supplier);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $inventaris->deleteInventoryItem($id);
}
?>
