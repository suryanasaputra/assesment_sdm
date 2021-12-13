<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}

$usernama = $_POST['usernama'];
$username = $_POST['username'];
$password = $_POST['password'];
// $password = $password = password_hash($password,PASSWORD_DEFAULT);
$query = "INSERT INTO user_kuis VALUES ('','$usernama','$username','$password')";
$result=mysqli_query($con, $query);
echo json_encode(array("status" => TRUE));

?>