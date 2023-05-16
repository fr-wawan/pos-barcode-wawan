<?php
include_once("../../config/database.php");

session_start();

if ($_SESSION['username'] == "") {
    header('location:../index.php');
}


$queryId = $_GET['id'];


$sql = "DELETE FROM tb_category WHERE id='$queryId'";
$result = $pdo->exec($sql);
if ($result) {
    header('location:index.php');
} else {
    echo "<script> alert('Data gagal dihapus')</script>";
}
