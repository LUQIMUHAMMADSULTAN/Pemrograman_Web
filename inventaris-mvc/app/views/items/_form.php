<?php 
$value = fn(string $key, $default = '') => e($item[$key] ?? $default); 
$selectedCategory = $item['category_id'] ?? '';
?>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control" value="<?= $value('code') ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="<?= $value('name') ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kategori</label>
        <select name="category_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $selectedCategory == $cat['id'] ? 'selected' : '' ?>>
                    <?= e($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Jumlah / Stok</label>
        <input type="number" name="quantity" class="form-control" value="<?= $value('quantity', 0) ?>" min="0">
    </div>
    <div class="col-md-3">
        <label class="form-label">Satuan</label>
        <input type="text" name="unit" class="form-control" value="<?= $value('unit', 'unit') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" step="0.01" name="price" class="form-control" value="<?= $value('price', 0) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="entry_date" class="form-control" value="<?= $value('entry_date') ?>">
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" rows="3" class="form-control"><?= $value('description') ?></textarea>
    </div>
</div>