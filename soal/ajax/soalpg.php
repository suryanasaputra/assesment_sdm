<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"])) {
  header("Location: ".base_url."login.php");
  exit;
}

$_SESSION["mulai_kuis"] = 'ya';
$bataswaktu = 900;
if (!isset($_SESSION["mulai_timestamp"])) {
  $_SESSION["mulai_timestamp"] = time();
  }
$ts1 = $_SESSION["mulai_timestamp"];
$ts2 = time();     
$seconds_diff = $ts2 - $ts1;           
$filteredNumbers = array_filter(preg_split("/\D+/", $_SESSION["session"]));
$firstOccurence = reset($filteredNumbers);

//ganti limit untuk total soal bertambah
$query = "SELECT count(*) as c FROM soal limit 10";
$result = mysqli_query($con, $query);
$num = mysqli_fetch_assoc($result);
$totalsoal = $num['c'];
if(isset($_SESSION["mulai_terhenti"]) && $_SESSION["mulai_terhenti"] >= $totalsoal): ?>
<script>
swal({
	title: "SELESAI",
  text: 'Anda sudah mengerjakan soal!',
	 imageUrl: '../assets/img/finish.png'
    },  function(){ 
  location.reload();
  });
</script>
<?php 
unset($_SESSION["mulai_kuis"]);
elseif($seconds_diff > $bataswaktu) : ?>
<script>
swal({
	title: "SELESAI",
  text: 'Anda sudah mengerjakan soal!',
	 imageUrl: '../assets/img/finish.png'
    },  function(){ 
  location.reload();
  });
</script>
<?php 
unset($_SESSION["mulai_kuis"]);
endif;  
?>
<div class="row">

	<center><div id="app"></div></center>   
  
<div class="col-sm-12 text-center">
	
		<?php 

		$no= isset($_SESSION["mulai_terhenti"]) ? $_SESSION["mulai_terhenti"] + 1 : 1;
		$soal = mysqli_query($con,"SELECT * FROM soal ORDER BY RAND(".$firstOccurence.") LIMIT ".($no-1).",".($totalsoal-($no-1)));
    $update = mysqli_query($con,"SELECT log FROM score WHERE id= ".$_SESSION['id']);
    $list = array();
    if (mysqli_num_rows($update) > 0 ) {
      $json = mysqli_fetch_assoc($update);
      $list = json_decode($json["log"]);
    }
    while ($row = mysqli_fetch_assoc($soal)) : ?>
			<?php
			$jawaban = mysqli_query($con,"SELECT * FROM jawaban WHERE id_soal = '".$row["id"]."' ORDER BY RAND()  "); ?>
			
			<form id="form_jawab_<?= $no; ?>" method="POST" action="ajax/hasil1.php" <?php if( ($no > 1 && !isset($_SESSION["mulai_terhenti"])) || (isset($_SESSION["mulai_terhenti"]) && ($no - $_SESSION["mulai_terhenti"]) > 1) ) {echo 'style="display:none;"';} ?>>
			<p><?= $no; ?>. <?= $row['soal']; ?></p> 
      <h5 style="text-align: right;">
        Pertanyaan <?= $no; ?> dari <?php echo $totalsoal; ?>
      </h5>
      		
			<div class="kotak">
			<?php 
			$total = mysqli_num_rows($jawaban);
			while ($rowjwb=mysqli_fetch_assoc($jawaban)) : 
			
			if ($total== 4) {
				$abjad = 'A';

			}elseif($total== 3) {
				$abjad = 'B';

			}elseif($total== 2) {
				$abjad = 'C';

			}else{
				$abjad='D';
			}
			?>
				
				<div class="row">				  
				  <div class="col-lg-12">
				  	<input type="hidden" id="id" name="id" value="<?=$row['id'] ?>">
				  	<input type="hidden" name="sementara" value="<?=$no; ?>">
				    <div class="input-group">
				      <span class="input-group-addon" style="background-color: #fff;"><input class="cursor" type="radio" id="jawaban_<?=$no; ?>" name="jawaban" value="<?=$rowjwb['pilihan_jawab'] ?>"
              <?php if($list && array_key_exists($no-1,$list) && $list[$no-1] == $rowjwb['pilihan_jawab']) :?> checked<?php endif;?>></span>
				      <input type="text" class="form-control" style="background-color: #fff;" value="<?=$abjad.'. '. $rowjwb['pilihan_jawab'] ?>" readonly>
				      
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!-- /.row -->

			<?php $total--; endwhile; ?>
			
			</div>
			
			<br>
				<?php 
        $last = false;
        $update = mysqli_query($con,"SELECT log FROM score WHERE id= ".$_SESSION['id']);
        if (mysqli_num_rows($update) > 0 ) {
          $json = mysqli_fetch_assoc($update);
          $list = json_decode($json["log"]);
          $last = count($list); ?>
        <?php if($last) :?>
          <?php if($last >= $no && $no > 1): ?>
            <button id="btn_pilih_<?= $no-1; ?>" type="submit" name="page" value="<?= $no-1; ?>" class="btn btn-lg btn-primary">Prev</button>
               <?php endif; ?>
        <?php endif; ?>

      <?php for ($i=1; $i <= count($list) ; $i++) { ?> 
        <?php if($i > ($_SESSION["mulai_terhenti"] - 4) && $i <= $_SESSION["mulai_terhenti"] ) : ?>
          <button id="btn_pilih_<?= $i; ?>"  type="submit" name="page" value="<?= $i; ?>" class="btn btn-lg btn-primary"><?php echo $i; ?></button>
          <?php elseif($i < ($_SESSION["mulai_terhenti"] + 4) && $i >= $_SESSION["mulai_terhenti"] ) : ?>
          <button id="btn_pilih_<?= $i; ?>"  type="submit" name="page" value="<?= $i; ?>" class="btn btn-lg btn-primary"><?php echo $i; ?></button>
        <?php endif; ?>
        <?php } }?>
        
        <?php if($last) :?>
          <?php if($last > $no ): ?>
         <button id="btn_pilih_<?= $last; ?>" type="submit" name="akhir" value="<?= $last; ?>" class="btn btn-lg btn-primary">LAST</button>
            <?php else : ?>
              <button id="btn_pilih_<?= $no; ?>" type="submit" name="sementara" value="<?= $no; ?>" class="btn btn-lg btn-primary">NEXT</button>
            <?php endif; ?>
        <?php else : ?>
          <button id="btn_pilih_<?= $no; ?>" type="submit" name="sementara" value="<?= $no; ?>" class="btn btn-lg btn-primary">NEXT</button>
        <?php endif; ?>
      </form>     
			
			
			<script>		
				$("#form_jawab_<?php echo $no; ?>").submit(function(){
					
					var next = '<?php echo $no+1; ?>';
					if (! $("#jawaban_<?=$no; ?>:checked").val()) {
				       swal({
							  title: "PILIH JAWABAN",
							  text: "Anda belum memilih jawaban!",
							  imageUrl: '../assets/img/silang.png'
							});
				        return false;
					}else{
					    var formData = $(this).closest('form').serializeArray();
              formData.push({ name: $(document).context.activeElement.name, value: $(document).context.activeElement.value });
              $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: formData,
              success: function(data) {
                var myarr = JSON.parse(data);
                 if(myarr["selesai"]){
                  swal({
                      title: myarr["title"],
                      text: myarr["selesai"],
                      imageUrl: myarr["img"]
                          },  function(){ 
                    location.reload();
                });
                 }
                 else {
                  location.reload();
                 }
									
								return false;
								}
						});
						return false;
					 }
					

				});


			</script>


		<?php 
		$no++;
		
		endwhile;


	 ?>
		
        
      </div>

</div>

<script type="text/javascript">

      const FULL_DASH_ARRAY = 283;
      const WARNING_THRESHOLD = 10;
      const ALERT_THRESHOLD = 5;

      const COLOR_CODES = {
        info: {
          color: "green"
        },
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

      document.getElementById("app").innerHTML = `
          <g class="base-timer__circle">
            <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
            <path
              id="base-timer-path-remaining"
              stroke-dasharray="283"
              class="base-timer__path-remaining ${remainingPathColor}"
              d="
                M 50, 50
                m -45, 0
                a 45,45 0 1,0 90,0
                a 45,45 0 1,0 -90,0
              "
            ></path>
          </g>
        </svg>
        <span id="base-timer-label" class="base-timer__label">${formatTime(
          timeLeft
        )}</span>
      </div>
      `;

      startTimer();

      function onTimesUp() {
        clearInterval(timerInterval);
      }

      function startTimer() {
        timerInterval = setInterval(() => {
          timePassed = timePassed += 1;
          timeLeft = TIME_LIMIT - timePassed;
          document.getElementById("base-timer-label").innerHTML = formatTime(
            timeLeft
          );
          setCircleDasharray();
          setRemainingPathColor(timeLeft);

          if (timeLeft === 0) {
            onTimesUp();
          }
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
          document
            .getElementById("base-timer-path-remaining")
            .classList.remove(warning.color);
          document
            .getElementById("base-timer-path-remaining")
            .classList.add(alert.color);
        } else if (timeLeft <= warning.threshold) {
          document
            .getElementById("base-timer-path-remaining")
            .classList.remove(info.color);
          document
            .getElementById("base-timer-path-remaining")
            .classList.add(warning.color);
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
      </script>