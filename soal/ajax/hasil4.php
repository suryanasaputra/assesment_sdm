<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}

$bataswaktu = 900; 
$ts1 = $_SESSION["mulai_timestamp_ketelitian2"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;      

$id_user = $_SESSION['id'];
$record = mysqli_query($con,"SELECT * FROM score_ketelitian_2 WHERE id = $id_user ORDER BY id_soal ASC");
$log = array();
while ($row = mysqli_fetch_assoc($record)) {
    $log[] = $row;
}
$query = "INSERT INTO score_ketelitian_2 (id,id_soal,jawaban_1,jawaban_2) VALUES "; 
$update = array();
$values = array();
foreach ($_POST as $key => $value) {
  if(strcasecmp('jawaban_1',substr($key,0,9)) == 0){
    $nosoal = substr($key,9);
    $j1 = $value;
    $j2 = $_POST['jawaban_2'.$nosoal];
    if($log && array_search($nosoal, array_column($log, 'id_soal')) !== false) {
      $update[$nosoal] = "UPDATE score_ketelitian_2 SET jawaban_1='$j1',jawaban_2='$j2' WHERE id=$id_user and id_soal=$nosoal;"; 
    } else {
      $values[$nosoal] = "('$id_user','".$nosoal."','".$j1."','".$j2."')";
    }
  }
}
if($values){
  $query .= implode(",",$values).';'.implode(' ',$update);
} else {
  $query = implode(' ',$update);
}
$result=mysqli_multi_query($con, $query);

if($seconds_diff > $bataswaktu){
  $_SESSION["mulai_ketelitian2"] = 'ya';
  $selesai = "Waktu menyelesaikan soal sudah habis!";
	$img = '../assets/img/timeup.png';
	$title = "WAKTU HABIS";
} else {
  if(isset($_POST['submit']))
  $_SESSION["mulai_ketelitian2"] = 'ya';
	$selesai = "Anda sudah menyelesaikan soal!";
	$img = '../assets/img/finish.png';
	$title = "SELESAI";
}
echo json_encode(array("status" => TRUE,"title"=>$title,"img"=>$img, "selesai"=>$selesai));

