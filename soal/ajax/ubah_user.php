<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}

$id = $_POST['id'];
$usernama = $_POST['usernama'];
$username = $_POST['username'];
$password = $_POST['password'];
// $password = password_hash($password,PASSWORD_DEFAULT);
$query = "UPDATE user_kuis SET usernama='$usernama', username='$username', password='$password' WHERE id = '$id' ";
$result=mysqli_query($con, $query);
echo json_encode(array("status" => TRUE));

?>