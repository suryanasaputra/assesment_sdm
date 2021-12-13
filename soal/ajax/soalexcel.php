<?php 
  session_start();
  require "../../koneksi.php";
  if (!isset($_SESSION["login"])) {
    header("Location: ".base_url."login.php");
    exit;
 }
 //$bataswaktu = 1200;
  if (!isset($_SESSION["mulai_timestamp_excel"])) {
  $_SESSION["mulai_timestamp_excel"] = time();
  }
  $ts1 = $_SESSION["mulai_timestamp_excel"];
  $ts2 = time();     
  $seconds_diff = $ts2 - $ts1;           
  $_SESSION['mulai_kuis_excel'] = 'ya';
?>

<section class="section is-medium" style="height: auto !important;">
	<center><div id="app" /></center>  

	<div class="container">
		<div class="content has-text-centered mb-5">
		</div>
	</div>

	<?php if(isset($_SESSION['mulai_excel']) == false) : ?>       
	<form id ="form_jawab" action="ajax/hasil6.php" method="post" enctype="multipart/form-data" accept-charset="utf-8" style="height: auto !important;">
		<?php if($_SESSION["posisi"] == 308 ){ ?>
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>





			<?php }elseif($_SESSION['posisi'] >= 399 AND $_SESSION['posisi'] <= 400){?>

				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>


			<?php }elseif($_SESSION['posisi'] == 374){?>
			
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>



			<?php }elseif($_SESSION['posisi'] == 376 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 309 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 266 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>


			<?php }elseif($_SESSION['posisi'] == 274 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 275 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 405 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 233 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] == 370 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>


			<?php }elseif($_SESSION['posisi'] >= 341 AND $_SESSION['posisi'] <= 347 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>


			<?php }elseif($_SESSION['posisi'] == 275 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php }elseif($_SESSION['posisi'] >= 224 AND $_SESSION['posisi'] <= 231 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>


			<?php }elseif($_SESSION['posisi'] >= 234 AND $_SESSION['posisi'] <= 237 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

					<?php }elseif($_SESSION['posisi'] == 224 ){?>
				
				<div id="box1">
					<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
			          <div class="nomor">
			            <label> BASIC</label>
			          </div>
			        </div>
				<center>
					<table>
						<td><img src="../assets/img/soal1.png" class="smallscreen" style="width: 100%;">
					</td>
					</table>
				</center>

					<table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					<table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
					</div>

			<?php
		// vlockup
		
		}elseif($_SESSION['posisi'] == 222 ){?>
				<div id="box1">
          		
				  <div id="box1">
					  <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
						<div class="nomor">
						  <label>  VLOOKUP</label>
						</div>
					  </div>
				  <center>
						  
					  <table>
  
						  <td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
					  </table>
				  </center>
				  <br>
				  <br>
  
				  <table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					  <table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>

			<?php }elseif($_SESSION['posisi'] == 223 ){?>

				<div id="box1">
          		
				  <div id="box1">
					  <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
						<div class="nomor">
						  <label>  VLOOKUP</label>
						</div>
					  </div>
				  <center>
						  
					  <table>
  
						  <td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
					  </table>
				  </center>
				  <br>
				  <br>
  
				  <table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					  <table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>

			  
			<?php }elseif($_SESSION['posisi'] == 281 ){?>

				<div id="box1">
          		
				  <div id="box1">
					  <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
						<div class="nomor">
						  <label>  VLOOKUP</label>
						</div>
					  </div>
				  <center>
						  
					  <table>
  
						  <td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
					  </table>
				  </center>
				  <br>
				  <br>
				  <table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
				 </table>


				  
			<?php }elseif($_SESSION['posisi'] == 368 ){?>

				<div id="box1">
          		
				  <div id="box1">
					  <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
						<div class="nomor">
						  <label>  VLOOKUP</label>
						</div>
					  </div>
				  <center>
						  
					  <table>
  
						  <td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
					  </table>
				  </center>
				  <br>
				  <br>
  
				  <table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>


			<?php }elseif($_SESSION['posisi'] >= 425 AND $_SESSION['posisi'] <= 427){?>

				<div id="box1">
          		
				  <div id="box1">
					  <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
						<div class="nomor">
						  <label>  VLOOKUP</label>
						</div>
					  </div>
				  <center>
						  
					  <table>
  
						  <td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
					  </table>
				  </center>
				  <br>
				  <br>
  
				  <table>
						<td> Download format: &nbsp;</td>
						<td><a href="ajax/download.php"> Download</a></td>
					</table>
					  <table>
						<td> Upload Jawaban: &nbsp;</td>
						<td><input type="file" name="jawaban" class="from_control" /></td>
					</table>
							
					<?php }elseif($_SESSION['posisi'] == 193 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 433 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 268 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 279 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 282 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 171 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] >= 174 AND $_SESSION['posisi'] <= 176 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 379 ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 277  ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

					<?php }elseif($_SESSION['posisi'] == 278  ){?>

						<div id="box1">
						
						<div id="box1">
							<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
								<div class="nomor">
								<label>  VLOOKUP</label>
								</div>
							</div>
						<center>
								
							<table>
		
								<td><img src="../assets/img/soal5.png" style="width: 100%;"></td>
							</table>
						</center>
						<br>
						<br>
		
						<table>
								<td> Download format: &nbsp;</td>
								<td><a href="ajax/download.php"> Download</a></td>
							</table>
							<table>
								<td> Upload Jawaban: &nbsp;</td>
								<td><input type="file" name="jawaban" class="from_control" /></td>
							</table>

			<?php }?>

          		
				
				
				</div>
				</div>
			<br>

		<div class="content has-text-centered mt-5"> 
			<center>
				<button type="submit" name="submit" class="btn btn-lg btn-primary">SUBMIT</button>
			</center> 
		</div>
	</form>

	<?php else :  ?>

<script>
    swal({
      title: "SELESAI",
    text: 'Anda sudah mengerjakan soal!',
      imageUrl: '../assets/img/finish.png'
      },  function(){ 
    location.reload();
    });
  </script>

  <?php endif; ?>

</section>

<script>


$(document).on('submit',"form[name='form_jawab']",function(e){

		let filename = $('input[type="file"]').val();
		let parts = filename.length > 0 ? filename.split('.') : [];
		let filetype = parts.length > 0 ? parts[parts.length - 1].toLowerCase() : '';
		if(e.originalEvent === undefined || filetype == 'xls' || filetype == 'xlsx'){
	
				e.preventDefault();
				var post = new FormData(this);
				var self = this;
				let option = {};
				option['method'] = 'POST';
				option['url'] = $(this).attr('action');
				option['data'] = post;
				option['processData'] = false;
				option['contentType'] = false;
				var trigger = false;
				$('#loader').show();

				$.each($(this).serializeArray(),function(){

				alert('Data berhasil disimpan ');

					if(this.value.length > 0)
				
					trigger = true;
				});
				//  success: function(data) {
				//     var myarr = JSON.parse(data);
				//       swal({
				//           title: myarr["title"],
				//           text: myarr["selesai"],
				//           imageUrl: myarr["img"]
				//               },  function(){ 
				//         location.reload();
				//     });

			
			}else{

						swal({
								title: 'Format File tidak benar',
								text: 'Maaf hanya xls dan xlsx yang boleh di upload',
								imageUrl: '../assets/img/timeup.png'
									},  function(){ 
								location.reload();
							});


			}
      });
    });
  });












// $("#form_jawab").on('submit', function(e){
// e.preventDefault();
// var formData = new FormData(this);
// jQuery.each(jQuery('input[type="file"]')[0].files, function(i, file) {
//     formData.append('jawaban', file);
// });
// let filename = $('input[type="file"]').val();
// let parts = filename.length > 0 ? filename.split('.') : [];
// let filetype = parts.length > 0 ? parts[parts.length - 1].toLowerCase() : '';
// if(e.originalEvent === undefined || filetype == 'xls' || filetype == 'xlsx'){
// 	$.ajax({
//   type: 'POST',
//   url: $(this).attr('action'),
//   data: formData,
//   cache: false,
//     contentType: false,
//     processData: false,
//     method: 'POST',
//     type: 'POST', // For jQuery < 1.9
//   success: function(data) {
//     var myarr = JSON.parse(data);
//       swal({
//           title: myarr["title"],
//           text: myarr["selesai"],
//           imageUrl: myarr["img"]
//               },  function(){ 
//         location.reload();
//     });

// 	}

// 	});

// } else {

// 		swal({
//           title: 'Format File tidak benar',
//           text: 'Maaf hanya xls dan xlsx yang boleh di upload',
//           imageUrl: '../assets/img/timeup.png'
//               },  function(){ 
//         location.reload();
//     });
		
	
// }
  
		
// });

</script>

<script>
	const FULL_DASH_ARRAY = 283;
	const WARNING_THRESHOLD = 10;
	const ALERT_THRESHOLD = 5;

	const COLOR_CODES = {
		info: {color: "green"},
		warning: {
			color: "orange",
			threshold: WARNING_THRESHOLD
		},
		alert: {
			color: "red",
			threshold: ALERT_THRESHOLD
		}
	};

	const TIME_LIMIT = <?php echo $bataswaktu; ?>;
    let timePassed = <?php echo $seconds_diff > $bataswaktu ? $bataswaktu-1 :$seconds_diff ; ?>;
	let timeLeft = TIME_LIMIT;
	let timerInterval = null;
	let remainingPathColor = COLOR_CODES.info.color;

	function onTimesUp() {
		clearInterval(timerInterval);
		$("#form_jawab").submit();
	}

	function startTimer() {
		timerInterval = setInterval(() => {
			timePassed = timePassed += 1;
			timeLeft = TIME_LIMIT - timePassed;
			document.getElementById("base-timer-label").innerHTML = formatTime(timeLeft);
			setCircleDasharray();
			setRemainingPathColor(timeLeft);

			if (timeLeft === 0) {onTimesUp(); }
		}, 1000);
	}

	function formatTime(time) {
		const minutes = Math.floor(time / 60);
		let seconds = time % 60;

		if (seconds < 10) {
			seconds = `0${seconds}`;
		}

		return `${minutes}:${seconds}`;
	}

	function setRemainingPathColor(timeLeft) {
		const { alert, warning, info } = COLOR_CODES;
		if (timeLeft <= alert.threshold) {
			document.getElementById("base-timer-path-remaining").classList.remove(warning.color);
			document.getElementById("base-timer-path-remaining").classList.add(alert.color);
		} else if (timeLeft <= warning.threshold) {
			document.getElementById("base-timer-path-remaining").classList.remove(info.color);
			document.getElementById("base-timer-path-remaining").classList.add(warning.color);
		}
	}

	function calculateTimeFraction() {
		const rawTimeFraction = timeLeft / TIME_LIMIT;
		return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
	}

	function setCircleDasharray() {
		const circleDasharray = `${(
			calculateTimeFraction() * FULL_DASH_ARRAY
			).toFixed(0)} 283`;
		document
		.getElementById("base-timer-path-remaining")
		.setAttribute("stroke-dasharray", circleDasharray);
	}

	document.getElementById("app").innerHTML = `
				<g class="base-timer__circle">
					<circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
					<path
						id="base-timer-path-remaining"
						stroke-dasharray="283"
						class="base-timer__path-remaining ${remainingPathColor}"
						d="M 50, 50 m -45, 0 a 45,45 0 1,0 90,0 a 45,45 0 1,0 -90,0"
					/>
				</g>
			</svg>
			<span id="base-timer-label" class="base-timer__label">${formatTime(timeLeft)}</span>
		</div>
	`;

	startTimer();
</script>
