<?php 
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require "../koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="1800;url=logout.php" /> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TVIP | TEST 4</title>

    <!-- Bootstrap -->
    <link href="../assets/img/logotvip.png" rel="icon">
    <link href="../assets/img/logotvip.png" rel="apple-touch-icon">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
     <!-- sweeat alert -->
    <link href="../assets/sweet_alert/dist/sweetalert.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/datatables/dataTables.bootstrap.css">
  </head>
  <body>

    <div class="container">

      <div class="navigasi">

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="startsoalketelitian2.php"><img alt="Brand" src="../assets/img/tvip.png" width="30"></a>
              
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Menu <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php if ($_SESSION['user'] =='admin' || $_SESSION['user'] =='sigit' ) { ?>
                    <!-- <li><a onclick="manage_user()">Manage User</a></li> -->
                    <!-- <li><a onclick="soaljawab()">Multiple Choice Questions</a></li> -->
                    <!-- <li><a onclick="scorepg()">Multiple Choice Score</a></li>
                    <li><a onclick="scoredisc()">Personality Profile Assessment Score</a></li>  -->
                    <li role="separator" class="divider"></li>         
                    <?php  }  ?>
                    <!-- <li><a href="startsoalpg.php">Test 1</a></li> -->
                    <li><a href="startsoaldisc.php">Test 1</a></li>
                    <li><a href="startsoalmbti.php">Test 2</a></li>
                    <li><a href="startsoalketelitian1.php">Test 3</a></li>
                    <li><a href="startsoalketelitian2.php">Test 4</a></li>
                    <li><a href="startsoalexcel.php">Test 5</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </div>

      <div class="isi">
        <div class="jumbotron">
          <div id="kontenku">
            <div class="row">

              <div class="col-sm-12">
                <img src="../assets/img/tvip.png" alt="../assets/img/tvip.png" class="img img-responsive imgku" width="140">
              </div>
              <div class="col-sm-12 text-center">
                <br>
                <h2><strong>Selamat Datang,</strong> <strong style="text-transform: uppercase;"><?= $_SESSION["user"]; ?></strong></h2>
                <p><strong>TEST 4</strong></p>
                  <div class="alert alert-warning alert-dismissible text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                     <strong>Instruksi</strong> : Pastikan anda mengikuti instruksi dibawah ini sebelum anda mengerjakan test.
                     <br>Membutuhkan waktu <strong>10 menit</strong>.
                     <br>Jika anda melewati waktu yang sudah ditentukan maka anda dinyatakan gagal. 
                     <br>Pada test ini anda akan menemukan deret angka. Pada setiap deret angka tersebut mempunyai pola seperti
                      penjumlahan, pengurangan, perkalian, pembagian dan mix pola. Tugas anda adalah menemukan pola dari deret angka tersebut dan melanjutkan angka pada kolom yang kosong.  <br>Silahkan klik <strong>START</strong> untuk memulai.
                  </div>
                <br>
                <p><a class="btn btn-primary btn-lg" onclick="mulai()" role="button"><strong>START</strong></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer">
        <p>&copy;Copyright 2020 ICT Department - TVIP. All Rights Reserved.</p>
      </div>      

        


    </div>
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- sweetalert -->
    <script src="../assets/sweet_alert/dist/sweetalert.min.js"></script>
    <!-- datatable -->
    <script src="../assets/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/dataTables.bootstrap.min.js"></script>

    <script>
   // <?php if(isset($_SESSION["mulai_kuis_ketelitian2"]) && isset($_SESSION["mulai_ketelitian2"]) == false) : ?>
    mulai();
     <?php endif; ?>

      function mulai() {
        $('#kontenku').load('ajax/soalketelitian2.php');
      }
      function soaljawab() {
        $('#kontenku').load('ajax/soaljawab.php');
      }
      // function scorepg() {
      //   $('#kontenku').load('ajax/scorepg.php');
      // }
      // function scoredisc() {
      //   $('#kontenku').load('ajax/scoredisc.php');
      // }
      function manage_user() {
        $('#kontenku').load('ajax/user.php');
      }
    </script>
   
  </body>
</html>