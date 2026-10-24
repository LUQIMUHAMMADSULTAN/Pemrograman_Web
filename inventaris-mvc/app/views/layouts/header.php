<?php $flash = take_flash(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? e($title) . ' - ' : '' ?><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar Utama -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASEURL ?>"><?= APP_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>/items">Data Barang</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>/categories">Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>/transactions">Transaksi</a></li>
            </ul>
            <!-- Bagian Kanan Navbar (Username & Tombol Logout) -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item me-3">
                    <span class="nav-link text-warning mb-0">Halo, <?= e($_SESSION['username'] ?? 'Admin') ?></span>
                </li>
                <li class="nav-item">
                    <form action="<?= BASEURL ?>/auth/logout" method="post" class="d-inline">
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-2">
<?php if ($flash): ?>
    <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
        <?= e($flash['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>