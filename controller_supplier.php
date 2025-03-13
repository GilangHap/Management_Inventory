<?php
require_once 'Class/supplier.php';

$supplier = new Supplier();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $supplier->updateSupplier($id, $name, $contact);
    } else {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $supplier->addSupplier($name, $contact);
        header('Location: tampil_supplier.php');
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $supplier->deleteSupplier($id);
}
?>