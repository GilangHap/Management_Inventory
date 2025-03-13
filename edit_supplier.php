<?php
require_once 'Class/supplier.php';

$supplier = new Supplier();
$id = $_GET['id'];
$currentSupplier = $supplier->getSupplierById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $supplier->updateSupplier($id, $name, $contact);
    header('Location: tampil_supplier.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="fas fa-boxes"></i> Manajemen Inventaris</a>
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
                    <h2 class="dashboard-title"><i class="fas fa-plus"></i> Edit Supplier</h2>
                </div>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus me-2"></i> Form Edit Supplier
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Supplier</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($currentSupplier['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($currentSupplier['contact']) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="tampil_supplier.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
