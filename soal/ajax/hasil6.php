<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}

$gambar = $_FILES["jawaban"]["name"];
$tmp_name = $_FILES["jawaban"]["tmp_name"];
$ukuran = $_FILES["jawaban"]["size"];
$tipe = $_FILES["jawaban"]["type"];
$error = $_FILES["jawaban"]["error"];


    $tipeGambarAman = ['xls', 'xlsx'];
      $ekstensiGambar = explode('.', $gambar);
      $ekstensiGambar = strtolower(end($ekstensiGambar));

      if( ! in_array($ekstensiGambar, $tipeGambarAman) ) {
        echo "<script>
            alert('yang anda pilih bukan excel!');
            document.location.href = '../startsoalexcel.php';
            </script>";
        return false;
      }else{



















$bataswaktu = 1200; 
$ts1 = $_SESSION["mulai_timestamp_excel"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;      

$id_user = $_SESSION['id'];
$record = mysqli_query($con,"SELECT * FROM score_excel WHERE id_user = $id_user ORDER BY id ASC");
$log = array();
while ($row = mysqli_fetch_assoc($record)) {
    $log[] = $row;
}
$query = "INSERT INTO score_excel (id,id_user,jawaban,tanggal_test) VALUES "; 
$update = array();
$values = array();
if($_FILES){
foreach ($_FILES as $key => $value) {
  if(strcasecmp('jawaban',substr($key,0,7)) == 0){
        $filtered_array = array_filter($log, function($val) use($id_user){
            return ($val['id_user']==$id_user);
        });
        if($log && count($filtered_array) > 0) {
              if($value['type'] == 'application/vnd.ms-excel' || $value['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                $blob = file_get_contents($value["tmp_name"]); 
                file_put_contents(dirname(__FILE__).'/../../jawaban_excel/'.$filtered_array[0]['jawaban'],$blob,FILE_APPEND | LOCK_EX);
                $jawaban = $filtered_array[0]['jawaban'];
                $update[] = "UPDATE score_mbti SET jawaban='$jawaban' WHERE id=$id_user and id=".$filtered_array[0]['id']." and tanggal_test='".$filtered_array[0]['tanggal_test']."';"; 
                break;
              } 
             
          } else {
                if($value['type'] == 'application/vnd.ms-excel' || $value['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                  $blob = file_get_contents($value["tmp_name"]); 
                  $tanggal_test = date("Y-m-d h:m:s",$ts2);
                  $filename = $id_user.'-'.$_SESSION["user"].'-'.date("d-m-Y",$ts2).'.'.pathinfo($value['name'], PATHINFO_EXTENSION);;
                  $path = dirname(__FILE__).'/../../jawaban_excel/'.$filename;
                  file_put_contents($path,$blob);
                  $values[] = "(NULL,'".$id_user."','".$filename."','".$tanggal_test."')";
                  break;
                } 
          }
    }
  }
} else {
  $tanggal_test = date("Y-m-d h:m:s",$ts2);
  $values[] = "(NULL,'".$id_user."','none','".$tanggal_test."')";
}

if($values){
  $query .= implode(",",$values).';'.implode(' ',$update);
} else {
  $query = implode(' ',$update);
}
$result=mysqli_multi_query($con, $query);

if($seconds_diff > $bataswaktu){
  $_SESSION["mulai_excel"] = 'ya';
  $selesai = "Waktu menyelesaikan soal sudah habis!";
  $img = '../assets/img/timeup.png';
  $title = "WAKTU HABIS";
} else {
  $_SESSION["mulai_excel"] = 'ya';
  $selesai = "Anda sudah menyelesaikan soal!";
  $img = '../assets/img/finish.png';
  $title = "SELESAI";
}
// echo json_encode(array("status" => TRUE,"title"=>$title,"img"=>$img, "selesai"=>$selesai));


echo "<script>
				alert('data berhasil ditambahkan!');
				document.location.href = '../startsoalexcel.php';
			  </script>";
}
?>



<script>

    

</script>