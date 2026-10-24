<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold">Tambah Barang</h3>
    <a href="<?= BASEURL ?>/items" class="btn btn-outline-secondary">Kembali</a>
</div>
<div class="card border-0 shadow-sm"><div class="card-body">
    <form action="<?= BASEURL ?>/items/store" method="post">
        <?php require ROOT_PATH . '/app/views/items/_form.php'; ?>
        <div class="mt-4"><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form>
</div></div>
<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>