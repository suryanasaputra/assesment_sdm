<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}

$id = $_POST['id'];
$query = "DELETE FROM soal WHERE id = '$id' ";
$result=mysqli_query($con, $query);
$query2 = "DELETE FROM jawaban WHERE id_soal = '$id' ";
$result2=mysqli_query($con, $query2);
echo json_encode(array("status" => TRUE));

?>