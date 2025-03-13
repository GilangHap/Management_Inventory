<div class="col-lg-3 col-md-4 sidebar position-sticky" style="top: 0;">
    <h4><i class="fas fa-th-large"></i> Menu Utama</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">
                <i class="fas fa-boxes"></i> Manajemen Inventaris
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'tampil_supplier.php' ? 'active' : '' ?>" href="tampil_supplier.php">
                <i class="fas fa-truck"></i> Daftar Supplier
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="log_inventaris.php">
                <i class="fas fa-chart-bar"></i> Log Inventaris
            </a>
        </li>
    </ul>
</div>
