<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold">Data Barang</h3>
    <a href="<?= BASEURL ?>/items/create" class="btn btn-primary">Tambah Barang</a>
</div>

<!-- Form Pencarian & Filter -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="<?= BASEURL ?>/items" method="get" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama barang..." value="<?= e($search) ?>">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $selectedCategory == $cat['id'] ? 'selected' : '' ?>>
                            <?= e($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary w-100">Filter & Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm"><div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th class="text-center">Stok</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($items)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Data barang tidak ditemukan.</td></tr>
            <?php else: foreach ($items as $i => $row): ?>
                <tr>
                    <td><?= ($offset ?? 0) + $i + 1 ?></td>
                    <td><code><?= e($row['code']) ?></code></td>
                    <td class="fw-semibold"><?= e($row['name']) ?></td>
                    <td><span class="badge bg-info text-dark"><?= e($row['category_name'] ?: 'Tanpa Kategori') ?></span></td>
                    <td class="text-center"><?= e($row['quantity']) ?> <?= e($row['unit']) ?></td>
                    <td><?= rupiah($row['price']) ?></td>
                    <td class="text-center">
                        <a href="<?= BASEURL ?>/items/edit/<?= e($row['id']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="<?= BASEURL ?>/items/delete/<?= e($row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginasi -->
    <?php if ($totalPages > 1): ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center mb-0">
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= ($p == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= BASEURL ?>/items?page=<?= $p ?>&search=<?= urlencode($search) ?>&category_id=<?= $selectedCategory ?>">
                            <?= $p ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>

</div></div>
<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>