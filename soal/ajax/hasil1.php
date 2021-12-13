<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}
if(isset($_POST["sementara"])) 
$_SESSION["mulai_terhenti"] = $_POST["sementara"];
if(isset($_POST["page"])) 
$_SESSION["mulai_terhenti"] = $_POST["page"]-1;
if(isset($_POST["akhir"])) 
$_SESSION["mulai_terhenti"] = $_POST["akhir"]-1;

$sementara = $_POST["sementara"];
$indexLog = $sementara - 1;
$bataswaktu = 900; 
$ts1 = $_SESSION["mulai_timestamp"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;      
$id = $_POST['id'];
$jawaban = $_POST['jawaban'];
$id_user = $_SESSION['id'];
$result=mysqli_query($con, "SELECT jawaban FROM soal WHERE id = '$id'");
$hasil = mysqli_fetch_assoc($result);
$data = '';
if($seconds_diff < $bataswaktu){
if ($hasil['jawaban']==$jawaban) {
	$data = 'jawaban anda benar, anda dapat 4 point';
	$nilai = 1;

	$cari = mysqli_query($con,"SELECT score FROM score WHERE id= '$id_user'");
	if (mysqli_num_rows($cari) > 0 ) {
		$score = mysqli_fetch_assoc($cari);

		$update = mysqli_query($con,"SELECT log FROM score WHERE id= '$id_user' and JSON_CONTAINS(log,".sprintf("'%s'", '"'.$jawaban.'"').",'$[$indexLog]')");
		if (mysqli_num_rows($update) == 0) {
		mysqli_query($con,"UPDATE score SET score = score + $nilai WHERE id='$id_user' ");
		}
		mysqli_query($con,"UPDATE score SET log = JSON_SET(log,'$[$indexLog]','$jawaban')  WHERE id='$id_user' ");
	
	}else{
		mysqli_query($con,"INSERT INTO score VALUES ('$id_user','$nilai',JSON_ARRAY())");
		mysqli_query($con,"UPDATE score SET log = JSON_SET(log,'$[$indexLog]','$jawaban')  WHERE id='$id_user' ");
	}
}else{
	$data = 'jawaban anda salah, anda dikurangi 1 point';
	$nilai = 0;
	$cari = mysqli_query($con,"SELECT score FROM score WHERE id='$id_user' ");
	if (mysqli_num_rows($cari) > 0) {
		$score = mysqli_fetch_assoc($cari);
		
		$update = mysqli_query($con,"SELECT log FROM score WHERE id= '$id_user' and JSON_CONTAINS(log,".sprintf("'%s'", '"'.$hasil['jawaban'].'"').",'$[$indexLog]')");
		if (mysqli_num_rows($update) > 0) {
			$nilai = 1;
		}
		mysqli_query($con,"UPDATE score SET score = score - $nilai WHERE id='$id_user' ");
		mysqli_query($con,"UPDATE score SET log = JSON_SET(log,'$[$indexLog]','$jawaban')  WHERE id='$id_user' ");
		
	}else{
		$nilai = 0;
		mysqli_query($con,"INSERT INTO score VALUES ('$id_user','$nilai',JSON_ARRAY())");
		mysqli_query($con,"UPDATE score SET log = JSON_SET(log,'$[$indexLog]','$jawaban')  WHERE id='$id_user' ");
	}
}
}else {
	$cari = mysqli_query($con,"SELECT score FROM score WHERE id='$id_user' ");
	if (mysqli_num_rows($cari) == 0) {
		$score = mysqli_fetch_assoc($cari);
		mysqli_query($con,"INSERT INTO score VALUES ('$id_user','0',JSON_ARRAY())");

	}
}

$filteredNumbers = array_filter(preg_split("/\D+/", $_SESSION["session"]));
$firstOccurence = reset($filteredNumbers);
$soal = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM soal ORDER BY RAND(".$firstOccurence.") DESC LIMIT 1"));
$nilaisekarang = mysqli_fetch_assoc(mysqli_query($con,"SELECT score FROM score WHERE id='$id_user' "));

// jika waktu sudah lewat dari batasan atau pertanyaan sudah selesai
if($soal["id"] == $_POST["id"] || $seconds_diff > $bataswaktu){
	$selesai = "Waktu menyelesaikan soal sudah habis!";
	$img = '../assets/img/timeup.png';
	$title = "WAKTU HABIS";
	if($soal["id"] == $_POST["id"]){	
	$selesai = "Anda sudah menyelesaikan soal!";
	$img = '../assets/img/finish.png';
	$title = "SELESAI";
	}
	unset($_SESSION['mulai_kuis']);
	echo json_encode(["title"=>$title,"img"=>$img, "selesai"=>$selesai,"text"=>$data,"score"=>$nilaisekarang['score']]);
} else {
	$title = "";
	$img = "";
	echo json_encode(["title"=>$title,"img"=>$img,"selesai"=>"","text"=>$data,"score"=>$nilaisekarang['score']]);
} 
?>