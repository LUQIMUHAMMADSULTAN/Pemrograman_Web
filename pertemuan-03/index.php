<?php
$nama = "Luqi Muhammad Sultan";
$nim = "2441024";
$prodi = "Teknik Informatika";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biodata Diri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
      body {
        font-family: "Times New Roman", serif;
        background-color: #eaf3f8;
      }

      h1 {
        text-align: center;
        margin-top: 20px;
      }

      .card {
        background-color: #ffffff;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-top: 30px;
      }

      table th {
        width: 30%;
      }
    </style>
  </head>
  <body>
    <h1>Kartu Mahasiswa</h1>

    <div class="d-flex justify-content-center">
      <div class="card" style="width: 22rem;">
        <img src="itaking.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-center">Info Mahasiswa</h5>

          <table class="table table-borderless table-sm">
            <tr>
              <th>Nama</th>
              <td><?php echo $nama; ?></td>
            </tr>
            <tr>
              <th>NIM</th>
              <td><?php echo $nim; ?></td>
            </tr>
            <tr>
              <th>Prodi</th>
              <td><?php echo $prodi; ?></td>
            </tr>
          </table>

          <div class="d-flex justify-content-center">
            <a href="kontak.php" class="btn btn-primary">Kontak pribadi</a>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>