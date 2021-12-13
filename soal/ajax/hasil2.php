<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}
$bataswaktu = 600; 
$ts1 = $_SESSION["mulai_timestamp_disc"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;      

$id_user = $_SESSION['id'];
$tipe_disc = $_POST['tipe_disc'];
$jawaban_disc_m = isset($_POST['jawaban_disc_m']) ? $_POST['jawaban_disc_m'] : array();
$jawaban_disc_l = isset($_POST['jawaban_disc_l']) ? $_POST['jawaban_disc_l'] : array();
$query = "INSERT INTO score_disc (id,tipe_disc,jawaban_disc_m,jawaban_disc_l) VALUES "; 
$values = array();
$update = array();
$totalsoal = 0;
if($jawaban_disc_l)
$totalsoal += count($jawaban_disc_l);
if($jawaban_disc_m)
$totalsoal += count($jawaban_disc_m);
$record = mysqli_query($con,"SELECT * FROM score_disc WHERE id = $id_user ORDER BY tipe_disc ASC");
$log = array();
while ($row = mysqli_fetch_assoc($record)) {
    $log[] = $row;
}
foreach (($jawaban_disc_l+$jawaban_disc_m) as $i => $value) {
  $m = array_key_exists($i,$jawaban_disc_m) == true ? $jawaban_disc_m[$i] : '';
  $l = array_key_exists($i,$jawaban_disc_l) == true ? $jawaban_disc_l[$i] : '';    
  if($log && array_search($i, array_column($log, 'tipe_disc')) !== false) {
    $update[$i] = "UPDATE score_disc SET jawaban_disc_m='$m',jawaban_disc_l='$l' WHERE id=$id_user and tipe_disc=$i;"; 
  } else {
    $values[$i] = "('$id_user','".$i."','".$m."', '".$l."')";
  }

}
if($values){
  $query .= implode(",",$values).';'.implode(' ',$update);
} else {
  $query = implode(' ',$update);
}
$result=mysqli_multi_query($con, $query);
if($seconds_diff > $bataswaktu){
  $_SESSION["mulai_profile"] = 'ya';
  $selesai = "Waktu menyelesaikan soal sudah habis!";
	$img = '../assets/img/timeup.png';
	$title = "WAKTU HABIS";
} else {
  if(isset($_POST['submit']))
  $_SESSION["mulai_profile"] = 'ya';
	$selesai = "Anda sudah menyelesaikan soal!";
	$img = '../assets/img/finish.png';
	$title = "SELESAI";
}
echo json_encode(array("status" => TRUE,"title"=>$title,"img"=>$img, "selesai"=>$selesai));

?>