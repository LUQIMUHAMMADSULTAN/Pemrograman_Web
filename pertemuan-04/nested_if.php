<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> nested_if </title>
</head>
<body>
    <?php
    
        $SudahLogin = true;
        $Peran = 'admin';

        if ($SudahLogin) {
            if ($Peran === 'admin') {
                echo "Selamat datang, Admin. Akses penuh.";
            } elseif ($peran === 'operator') {
                echo "Selamat datang, Operator. Akses terbatas.";
            } else {
                echo "Peran tidak di kenal.";
            }
        } else {
            echo "Silahkan login terlebih dahulu.";
        }

        $terverifikasi = true;
        $saldo = 120000;
        if ($SudahLogin && $terverifikasi && $saldo >= 100000) {
            echo "Transaksi besar diizinkan.";
        }
        ?>
</body>
</html>