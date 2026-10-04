<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> switch </title>
</head>
<body>
    <?php
        
        $pilihan = 2;

        switch ($pilihan) {
            case 1:
                echo "Lihat Saldo";
            break;
            case 2:
                echo "Transfer";
            break;
            case 3:
                echo "Bayar Tagihan";
            break;
            default:
                echo "Pilihan tidak valid";
        }

        $jawab = 'y';
        switch ($jawab) {
            case 'y':
            case 'Y':
                echo "<br>Anda menjawab YA";
            break;
            case 'n':
            case 'N':
                echo "<br>Anda mejawab TIDAK";
            break;
            default:
                echo "J<br>awaban tidak dikenali";
        }

        $k = 1;
        echo "<br>Tanpa break: ";
        switch ($k) {
            case 1: echo "Satu";
            case 2: echo "Dua";
            case 3: echo "Tiga";
        }
        echo "\n";
    ?>
</body>
</html>