<?php
$nama = "Luqi Muhammad Sultan";
$noHp = "0812-3456-7890";
$email = "luqi@example.com";
$alamat = "Jl. Raya No. 123, Bandung";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Pribadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #eaf3f8;
      }
      .container {
        margin-top: 60px;
      }
      table {
        font-size: 1rem;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Kontak Pribadi</h3>

          <table class="table table-bordered">
            <tr>
              <th width="30%">Nama</th>
              <td><?php echo $nama; ?></td>
            </tr>
            <tr>
              <th>No. HP</th>
              <td><?php echo $noHp; ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo $email; ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td><?php echo $alamat; ?></td>
            </tr>
          </table>

          <div class="text-center mt-3">
            <a href="index.php" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>