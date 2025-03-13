<?php
require_once 'Class/inventaris.php';

$inventaris = new Inventaris();
$getInventoryLog = $inventaris->getInventoryLog();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Inventaris</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
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
            <div class="col-lg-3 col-md-4 sidebar">
                <h4><i class="fas fa-th-large"></i> Menu Utama</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-boxes"></i> Manajemen Inventaris
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tampil_supplier.php">
                            <i class="fas fa-truck"></i> Daftar Supplier
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="log_inventaris.php">
                            <i class="fas fa-chart-bar"></i> Log Inventaris
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Content -->
            <div class="col-lg-9 col-md-8 content">
                <div class="dashboard-header">
                    <h2 class="dashboard-title"><i class="fas fa-chart-bar"></i> Log Inventaris</h2>
                </div>

                <!-- Card untuk Tabel Log Inventaris -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table me-2"></i> Daftar Log Inventaris
                    </div>
                    <div class="card-body">
                        <table id="logTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Item</th>
                                    <th>Jumlah Perubahan</th>
                                    <th>Tanggal Perubahan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach ($getInventoryLog as $log) {
                                    $changeQuantity = intval($log['change_quantity']);
                                    $badgeClass = $changeQuantity < 0 ? 'bg-danger' : 'bg-success';
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($log['name']) ?></td>
                                        <td>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= htmlspecialchars($log['change_quantity']) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($log['change_date']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>© 2023 Manajemen Inventaris. All rights reserved.</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span>Versi 1.0.0</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "responsive": true,
                "pageLength": 10
            });
        });
    </script>
</body>
</html>
