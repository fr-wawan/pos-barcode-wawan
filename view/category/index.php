<?php
include_once("../../config/database.php");

session_start();

if ($_SESSION['username'] == "") {
  header('location:../index.php');
}

if (isset($_POST['submit'])) {
  $kat_name = htmlspecialchars($_POST['kategori']);

  if (empty($kat_name)) {
    echo "
    <script> alert('Nama kategori tidak boleh kosong')</script> 
    ";
  } else {
    $insert = $pdo->prepare("INSERT INTO tb_category (nm_cat) value(:cat)");
    $insert->bindParam(':cat', $kat_name);

    if ($insert->execute()) {
      echo "<script> alert('Data Berhasil Ditambah')</script>";
    } else {
      echo "<script> alert('Data Tidak Berhasil Ditambah')</script>";
    }
  }
}


?>

<?php
include_once("../inc/header.php");
include_once("../inc/admin_sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md">
          <div class="card mt-5">
            <div class="card-header">
              <h4 class="mt-2 ">Data Seluruh Kategori</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row mb-3 justify-content-between">
                <div class="col-sm-4">
                  Menampilkan <input type="number" class="form-control mx-1 d-inline" style="width: 15%;">
                  Data / Halaman
                </div>
                <div class="form-group row">
                  <label for="search" class="col-sm-4 font-weight-normal col-form-label" style="font-size: 18px;">Pencarian :</label>
                  <div class="col-sm-8">
                    <input type="text" name="search" class="form-control" id="search">
                  </div>
                </div>
              </div>
              <table class="table table-hover table-responsive-md text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sql = "SELECT * FROM tb_category";
                  $stmt = $pdo->query($sql);
                  while ($row = $stmt->fetch()) {
                    $id = $row["id"];
                    $cat = $row["nm_cat"];
                  ?>

                    <tr>
                      <td>
                        <?= $no++ ?>
                      </td>
                      <td>
                        <?= $cat ?>
                      </td>
                      <td>
                        <a href="update.php?id=<?= $id; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>
              <div class="d-flex align-items-center mt-4 justify-content-between">
                <div>
                  <h6>Menampilkan 1 dari 1 halaman</h6>
                </div>
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-3">
          <div class="card mt-5">
            <div class="card-header bg-blue">
              <h5 class="mt-2">Tambah kategori</h5>
            </div>
            <!-- /.card-header -->
            <form method="POST" action="">
              <div class="card-body">
                <div class="form-group">
                  <label for="katInput">Nama Kategori</label>
                  <input type="text" name="kategori" class="form-control" id="katInput">
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary" name="submit" type="submit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->


<?php
include_once("../inc/footer.php");
?>