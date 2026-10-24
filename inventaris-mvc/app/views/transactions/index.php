<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold">Riwayat Transaksi Barang</h3>
    <a href="<?= BASEURL ?>/transactions/create" class="btn btn-primary">Catat Transaksi</a>
</div>
<div class="card border-0 shadow-sm"><div class="card-body"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Kode / Barang</th>
                <th class="text-center">Jenis</th>
                <th class="text-center">Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($transactions)): ?>
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada riwayat transaksi.</td></tr>
        <?php else: foreach ($transactions as $i => $row): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($row['created_at']) ?></td>
                <td><code><?= e($row['item_code']) ?></code> - <?= e($row['name'] ?? $row['item_name']) ?></td>
                <td class="text-center">
                    <?php if ($row['type'] === 'IN'): ?>
                        <span class="badge bg-success">MASUK (IN)</span>
                    <?php else: ?>
                        <span class="badge bg-danger">KELUAR (OUT)</span>
                    <?php endif; ?>
                </td>
                <td class="text-center fw-bold"><?= e($row['quantity']) ?></td>
                <td class="text-muted"><?= e($row['notes'] ?: '-') ?></td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div></div></div>
<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>