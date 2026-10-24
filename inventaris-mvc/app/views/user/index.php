<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="mb-4">
    <h3 class="fw-bold">Dashboard</h3>
    <p class="text-muted">Selamat datang kembali, <strong><?= e($_SESSION['full_name'] ?? $_SESSION['username']) ?></strong>! Berikut ringkasan sistem inventaris.</p>
</div>

<!-- Kartu Statistik Dinamis -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title text-uppercase small opacity-75">Total Barang</h6>
                <h2 class="fw-bold mb-0"><?= $totalItems ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <h6 class="card-title text-uppercase small opacity-75">Total Kategori</h6>
                <h2 class="fw-bold mb-0"><?= $totalCategories ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
                <h6 class="card-title text-uppercase small opacity-75">Stok Menipis (&le; 5)</h6>
                <h2 class="fw-bold mb-0"><?= $lowStockItems ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Transaksi Terbaru -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Aktivitas Transaksi Terbaru</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode / Nama Barang</th>
                        <th class="text-center">Jenis</th>
                        <th class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($recentTransactions)): ?>
                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada aktivitas transaksi.</td></tr>
                <?php else: foreach ($recentTransactions as $trx): ?>
                    <tr>
                        <td><?= e($trx['created_at']) ?></td>
                        <td><code><?= e($trx['item_code']) ?></code> - <?= e($trx['item_name']) ?></td>
                        <td class="text-center">
                            <?php if ($trx['type'] === 'IN'): ?>
                                <span class="badge bg-success">MASUK (IN)</span>
                            <?php else: ?>
                                <span class="badge bg-danger">KELUAR (OUT)</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center fw-bold"><?= e($trx['quantity']) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>