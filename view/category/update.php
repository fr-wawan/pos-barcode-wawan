<?php
include_once("../../config/database.php");

session_start();

if ($_SESSION['username'] == "") {
    header('location:../index.php');
}


$queryId = $_GET['id'];

include_once("../inc/header.php");

if (isset($_POST['update'])) {
    $kat_name = htmlspecialchars($_POST['kategori']);

    $sql = "UPDATE tb_category SET nm_cat='$kat_name' WHERE id='$queryId'";
    $result = $pdo->query($sql);
    if ($result) {
        echo "<script> alert('Data Berhasil Diperbarui')</script>";
    } else {
        echo "<script> alert('Data Tidak Berhasil Diperbarui')</script>";
    }
}



?>

<?php
include_once("../inc/admin_sidebar.php");
?>

<div class="content-wrapper">

    <?php
    $sql = "SELECT * FROM tb_category WHERE id='$queryId'";
    $stmt = $pdo->query($sql);
    while ($rows = $stmt->fetch()) {
        $cat = $rows["nm_cat"];
    }
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-header bg-blue">
                            <h5 class="mt-2">Edit kategori</h5>
                        </div>
                        <form method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="katInput">Nama Kategori</label>
                                    <input type="text" name="kategori" class="form-control" id="katInput" value="<?= $cat ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" name="update" type="submit">Update</button>
                                <a href="index.php" class="btn btn-info">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>



<?php
include_once("../inc/footer.php");
?>