<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> else_if </title>
</head>
<body>
    <?php
        

        $nilai = 82;

        if ($nilai >= 85) {
            $huruf = 'A';
        } elseif ($nilai >= 75) {
            $huruf = 'B';
        } elseif ($nilai >= 65) {
            $huruf = 'C';
        } elseif ($nilai >= 50) {
            $huruf = 'D';
        } else {    
            $huruf = 'E';
        }

        echo "Nilai $nilai -> huruf mutu $huruf\n";

        $n = 90;
        if ($n >= 50) {
            $salah = 'D';
        } elseif ($n >= 85) {
            $salah = 'A';
        } else {
            $salah = 'E';
        }
        echo "<br>Urutan salah menghasilkan: $salah (seharusnya A)";

       ?>
</body>
</html>