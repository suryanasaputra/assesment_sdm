<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}

$id = $_POST['id'];
$jawaban = $_POST['pilihan_jawab'];
$query = "UPDATE jawaban SET pilihan_jawab='$jawaban' WHERE id = '$id' ";
$result=mysqli_query($con, $query);
echo json_encode(array("status" => TRUE));

?>