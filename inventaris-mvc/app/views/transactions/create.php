<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold">Catat Transaksi Barang</h3>
    <a href="<?= BASEURL ?>/transactions" class="btn btn-outline-secondary">Kembali</a>
</div>
<div class="card border-0 shadow-sm"><div class="card-body">
    <form action="<?= BASEURL ?>/transactions/store" method="post">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Pilih Barang <span class="text-danger">*</span></label>
                <select name="item_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item['id'] ?>">
                            <?= e($item['code']) ?> - <?= e($item['name']) ?> (Stok: <?= $item['quantity'] ?> <?= e($item['unit']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                <select name="type" class="form-select" required>
                    <option value="IN">Barang Masuk (IN)</option>
                    <option value="OUT">Barang Keluar (OUT)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                <input type="number" name="quantity" class="form-control" min="1" required>
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan</label>
                <textarea name="notes" rows="3" class="form-control" placeholder="Catatan transaksi..."></textarea>
            </div>
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary">Simpan Transaksi</button></div>
    </form>
</div></div>
<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>