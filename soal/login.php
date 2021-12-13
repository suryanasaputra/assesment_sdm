<?php 
session_start();
require "../koneksi.php";

if (isset($_SESSION["login"])) {
  header("Location: startsoaldisc.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TVIP | Kuis</title>

    <!-- Bootstrap -->
    <link href="../assets/img/logotvip.png" rel="icon">
    <link href="../assets/img/logotvip.png" rel="apple-touch-icon">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
     <!-- sweeat alert -->
    <link href="../assets/sweet_alert/dist/sweetalert.css" rel="stylesheet"/>
  </head>
  <body>
    <div class="container">

      <div class="navigasi">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="login.php">
                <img alt="Brand" src="../assets/img/tvip.png" width="30">
              </a>
            </div>
          </div>
        </nav>
      </div>
      <div class="isi">
        <div class="jumbotron">
          <div id="kontenku">
              <div class="row">
              
                  <div class="col-sm-12">
                    <img src="../assets/img/tvip.png" alt="../assets/img/tvip.png" class="img img-responsive imgku" width="140">
                    <br>
                  </div>
                  
                  <div class="col-sm-3"></div>


                  <?php 
                    if (isset($_POST["login"])) {
                        $username = mysqli_real_escape_string($con, htmlspecialchars($_POST["username"]));
                        $password = mysqli_real_escape_string($con, htmlspecialchars($_POST["password"]));
                        $query = "SELECT * FROM user_kuis WHERE username='$username'";
                        $result = mysqli_query($con, $query);
                        // cek username
                        if (mysqli_num_rows($result)===1) {
                          // cek password
                          $row = mysqli_fetch_assoc($result);
                          if (strcmp($password,$row["password"]) == 0) {
                            // set session
                            $_SESSION["login"] = true;
                            $_SESSION["user"] = $row["username"];
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["posisi"] = $row["posisi"];
                            $_SESSION["session"] = session_id();
                            
                            $query = "SELECT * FROM score WHERE id=".$row["id"] ;
                            $result = mysqli_query($con, $query);
                            // cek username
                            if (mysqli_num_rows($result)) {
                             $query = "SELECT count(*) as c FROM soal LIMIT 10";
                             $result = mysqli_query($con, $query);
                             $num = mysqli_fetch_assoc($result);
                             $totalsoal = $num['c'];
                              $_SESSION["mulai_terhenti"] =  $totalsoal;
                            }    
                            $query = "SELECT * FROM score_disc WHERE id=".$row["id"];
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result)) {
                             $_SESSION["mulai_profile"] = "ya";
                            }
                            $query = "SELECT * FROM score_ketelitian_1 WHERE id=".$row["id"];
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result)) {
                             $_SESSION["mulai_ketelitian1"] = "ya";
                            }
                            $query = "SELECT * FROM score_ketelitian_2 WHERE id=".$row["id"];
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result)) {
                             $_SESSION["mulai_ketelitian2"] = "ya";
                            }
                            $query = "SELECT * FROM score_mbti WHERE id=".$row["id"];
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result)) {
                             $_SESSION["mulai_mbti"] = "ya";
                            }
                            $query = "SELECT * FROM score_excel WHERE id_user=".$row["id"];
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result)) {
                             $_SESSION["mulai_excel"] = "ya";
                            }
                            header("Location: startsoaldisc.php");
                            exit;
                          }
                        }

                        $error = true;
                      }
                  ?>
                  <div class="col-sm-6">
                    <?php if (isset($error)) : ?>
                      <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Username / Password Salah !</strong>
                      </div>
                    <?php endif; ?>
                
                  <div class="panel panel-primary">
                    <div class="panel-heading"><strong>SILAHKAN LOGIN</strong></div>
                      <div class="panel-body">
                        <form method="POST" action="">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                          </div>                      
                          <button type="submit" name="login" class="btn btn-primary"><strong>LOGIN</strong></button>
                        </form>
                      </div>
                    </div>                   
                  </div>
                  <div class="col-sm-3"></div>

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
    
  </body>
</html>