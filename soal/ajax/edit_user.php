<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}
$id =$_GET['id'];
$query = "SELECT * FROM user_kuis WHERE id='$id'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
?>

<div class="form-group">
  <button class="btn btn-primary" style="float: right;" onclick="generate('password')">CREATE PASSWORD</button>
</div>
<form id="form_edit_user">
  <div class="form-group">
    <input type="hidden" name="id" value="<?=$row['id'] ?>">
    <label for="usernama">Nama</label>
    <input type="text" name="usernama" id="usernama" value="<?=$row['usernama'] ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?=$row['username'] ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
  </div>
</form>


