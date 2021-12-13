<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}
$bataswaktu = 600; 
$ts1 = $_SESSION["mulai_timestamp_mbti"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;      

$id_user = $_SESSION['id'];
$record = mysqli_query($con,"SELECT * FROM score_mbti WHERE id = $id_user ORDER BY id_soal ASC");
$log = array();
while ($row = mysqli_fetch_assoc($record)) {
    $log[] = $row;
}
$query = "INSERT INTO score_mbti (id,id_soal,tipe_mbti,jawaban) VALUES "; 
$update = array();
$values = array();
foreach ($_POST as $key => $value) {
  if(strcasecmp('jawaban_mbti_',substr($key,0,13)) == 0){
    $nosoal = substr($key,13);
    foreach ($value as $tipe => $jawaban) {
        $filtered_array = array_filter($log, function($val) use($nosoal, $tipe){
            return ($val['id_soal']==$nosoal and $val['tipe_mbti']==$tipe);
        });
        if($log && count($filtered_array) > 0) {
            $update[] = "UPDATE score_mbti SET jawaban='$jawaban' WHERE id=$id_user and id_soal=$nosoal and tipe_mbti=$tipe;"; 
          } else {
            $values[] = "('$id_user','".$nosoal."','".$tipe."','".$jawaban."')";
          }
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
  $_SESSION["mulai_mbti"] = 'ya';
  $selesai = "Waktu menyelesaikan soal sudah habis!";
	$img = '../assets/img/timeup.png';
	$title = "WAKTU HABIS";
} else {
  if(isset($_POST['submit']))
  $_SESSION["mulai_mbti"] = 'ya';
	$selesai = "Anda sudah menyelesaikan soal!";
	$img = '../assets/img/finish.png';
	$title = "SELESAI";
}
echo json_encode(array("status" => TRUE,"title"=>$title,"img"=>$img, "selesai"=>$selesai));

?>
