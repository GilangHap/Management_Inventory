<?php
require 'Class/inventaris.php';
require 'Class/supplier.php';

$inventaris = new Inventaris();
$supplier = new Supplier();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];

    $inventaris->addInventoryItem($name, $quantity, $price, $supplier_id);
    header('Location: index.php');
    exit;
}

$suppliers = $supplier->getSuppliers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Inventaris</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-boxes"></i> Manajemen Inventaris</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Content -->
            <div class="col-lg-9 col-md-8 content">
                <div class="dashboard-header d-flex justify-content-between align-items-center">
                    <h2 class="dashboard-title"><i class="fas fa-plus"></i> Tambah Inventaris</h2>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus me-2"></i> Form Tambah Inventaris
                    </div>
                    <div class="card-body">
                        <form action="tambah_inventaris.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <div class="input-group">
                                    <select class="form-control" id="supplier_id" name="supplier_id" required>
                                        <?php foreach ($suppliers as $supplier): ?>
                                            <option value="<?= htmlspecialchars($supplier['id']) ?>"><?= htmlspecialchars($supplier['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='tambah_supplier.php'">Tambah Supplier</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <!-- ...existing code... -->
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>