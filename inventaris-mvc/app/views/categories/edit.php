<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
   <div class="d-flex justify-content-between align-items-center mb-4">
       <h3 class="mb-0 fw-bold">Edit Kategori</h3>
       <a href="<?= BASEURL ?>/categories" class="btn btn-outline-secondary">Kembali</a>
   </div>
   <div class="card border-0 shadow-sm"><div class="card-body">
       <form action="<?= BASEURL ?>/categories/update" method="post">
           <input type="hidden" name="id" value="<?= e($category['id']) ?>">
           <?php require ROOT_PATH . '/app/views/categories/_form.php'; ?>
           <div class="mt-4"><button type="submit" class="btn btn-primary">Update</button></div>
       </form>
   </div></div>
   <?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>