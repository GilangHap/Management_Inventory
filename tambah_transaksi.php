<?php
require 'Class/inventaris.php';

$inventaris = new Inventaris();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $transaction_type = $_POST['transaction_type'];
    $quantity = $_POST['quantity'];

    $existingItem = $inventaris->getInventoryItemById($item_id);
    if ($existingItem) {
        if ($transaction_type === 'masuk') {
            $newQuantity = $existingItem['quantity'] + $quantity;
        } else if ($transaction_type === 'keluar') {
            $newQuantity = $existingItem['quantity'] - $quantity;
        }
        $inventaris->updateInventoryItemQuantity($item_id, $newQuantity);
    }
    header('Location: index.php');
    exit;
}

$items = $inventaris->getInventoryItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
                    <h2 class="dashboard-title"><i class="fas fa-plus"></i> Tambah Transaksi</h2>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus me-2"></i> Form Tambah Transaksi
                    </div>
                    <div class="card-body">
                        <form action="tambah_transaksi.php" method="POST">
                            <div class="mb-3">
                                <label for="item_id" class="form-label">Nama Item</label>
                                <select class="form-control" id="item_id" name="item_id" required>
                                    <?php foreach ($items as $item): ?>
                                        <option value="<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="transaction_type" class="form-label">Jenis Transaksi</label>
                                <select class="form-control" id="transaction_type" name="transaction_type" required>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
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