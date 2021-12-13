<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}

$soal = $_POST['soal'];
$jawaban = $_POST['jawaban'];
$query = "INSERT INTO soal VALUES ('','$soal','$jawaban')";
$result=mysqli_query($con, $query);
echo json_encode(array("status" => TRUE));

?>