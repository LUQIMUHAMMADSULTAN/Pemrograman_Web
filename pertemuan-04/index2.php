<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> if_else </title>
</head>
<body>
    <?php
        

        $nilai = 68;

        if ($nilai >= 75) {
            echo "Nilai $nilai: Lulus.\n";
        } else {
            echo "Nilai $nilai: Tidak Lulus.\n";
        }

        $n = 17;
        if ($n % 2 === 0) {
            echo "<br>$n adalah bilangan genap.\n";
        } else {
            echo "<br>$n adalah bilangan ganjil.\n";
        }?>
</body>
</html>