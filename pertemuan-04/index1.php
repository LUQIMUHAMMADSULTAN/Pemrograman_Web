<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> if </title>
</head>
<body>
    <?php
        

        $suhu = 38;

        if ($suhu > 37) {
            echo "suhu $suhu derajat: demam.\n";
        }

        $stok = 0;
        if ($stok === 0) {
            echo "<br>Stok habis.\n";
        }?>
</body>
</html>