<?php 
  session_start();
  require "../../koneksi.php";
  if (!isset($_SESSION["login"])) {
    header("Location: ".base_url."login.php");
    exit;
 }

  $bataswaktu = 600;
  if (!isset($_SESSION["mulai_timestamp_disc"])) {
  $_SESSION["mulai_timestamp_disc"] = time();
  }
  $ts1 = $_SESSION["mulai_timestamp_disc"];
  $ts2 = time();     
  $seconds_diff = $ts2 - $ts1;           
  $_SESSION['mulai_kuis_profile'] = 'ya';
?>

<script>
function updatedhasil() {
	var formData = $("#form_jawab").closest('form').serializeArray();
		$.ajax({
		type: 'POST',
		url: $("#form_jawab").attr('action'),
		data: formData,
		success: function(data) {
		var myarr = JSON.parse(data);
	}
		});
	}		
</script>
<section class="section is-medium" style="height: auto !important;">

	<center><div id="app" /></center>  

	<div class="container">
		<div class="content has-text-centered mb-5">
		</div>
	</div>
<?php if(isset($_SESSION['mulai_profile']) == false) : ?> 
	<form id ="form_jawab" action="ajax/hasil2.php" method="post" accept-charset="utf-8" style="height: auto !important;">
		<?php 
			$num = mysqli_query($con, "SELECT COUNT(tipe_disc)/4 AS hasil FROM `soal_disc`"); 
			while ($baris = mysqli_fetch_assoc($num)) {$brs = (integer)$baris['hasil']; }
		?>
		<?php for ($i=1; $i <= $brs ; $i++) : ?>
			<br>
			<input type="hidden" name="tipe_disc[]" value="<?php echo $i; ?>">
			<div id="box1">
				<div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
					<div class="nomor">
						<label> SOAL <?php echo $i; ?> </label>
					</div>
				</div>
				<label style="border: 1px solid; padding: 2px; background-color: #85C1E9;"> (M) (L) </label>
			</div>
			<?php 
			    $records = mysqli_query($con, "SELECT b.*, IF(a.jawaban_disc_m = b.jawaban_disc_m,'checked','') as jawaban_disc_m_checked, IF(a.jawaban_disc_l = b.jawaban_disc_l,'checked','') as jawaban_disc_l_checked FROM soal_disc as b LEFT JOIN score_disc as a on a.tipe_disc = b.tipe_disc and a.id = ".$_SESSION['id']." WHERE b.tipe_disc='$i' ");
			    $projects = array();
			    while ($project =  mysqli_fetch_assoc($records)) {$projects[] = $project; }
			?>
			<?php foreach ($projects as $project): ?>
				<div id="box2">
					<table>
						<tr>
							<td>
								<input 
									type="radio" 
									id="jawaban_disc_m_<?=$i?>_<?=$project['jawaban_disc_m']; ?>"  
									name="jawaban_disc_m[<?=$i;?>]"  
									value="<?=$project['jawaban_disc_m']; ?>"
									required 
									onclick="(function(){
										const answer = $(event.currentTarget).parent().siblings('td').find('input').is(':checked');
										if(answer) {
											$('#jawaban_disc_m_<?=$i?>_<?=$project['jawaban_disc_m']; ?>').prop('checked', false);
											alert(`Hanya dapat pilih salah satu`)
										}
										updatedhasil();
									})(event)" <?=$project['jawaban_disc_m_checked']; ?> /> &nbsp;&nbsp;
							</td>
							<td>
								<input 
									type="radio" 
									id="jawaban_disc_l_<?=$i?>_<?=$project['jawaban_disc_l']; ?>"  
									name="jawaban_disc_l[<?=$i;?>]"  
									value="<?=$project['jawaban_disc_l']; ?>"
									required
									onclick="(function(){
										const answer = $(event.currentTarget).parent().siblings('td').find('input').is(':checked');
										if(answer) {
											$('#jawaban_disc_l_<?=$i?>_<?=$project['jawaban_disc_l']; ?>').prop('checked', false);
											alert(`Hanya dapat pilih salah satu`)
										}
										updatedhasil();
									})(event)" <?=$project['jawaban_disc_l_checked']; ?>/> &nbsp;&nbsp;
							</td>
							<td><?php echo $project['deskripsi_disc']; ?></td>
						</tr>
					</table>
				</div> 
			<?php endforeach; ?>
		<?php endfor; ?>
		</div>
		<br>

		<div class="content has-text-centered mt-5"> 
			<center>
				<button type="submit" name="submit" value="yes" class="btn btn-lg btn-primary">SUBMIT</button>
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
		// location.reload();
		window.location = "http://assessment.tvip.co.id/essay/soal/startsoalmbti.php";

		});
</script>

	<?php endif; ?>

</section>

<script>
  $("#form_jawab").submit(function(){	
  var formData = $(this).closest('form').serializeArray();
  formData.push({ name: $(document).context.activeElement.name, value: $(document).context.activeElement.value });

  $.ajax({
  type: 'POST',
  url: $(this).attr('action'),
  data: formData,
  success: function(data) {
    var myarr = JSON.parse(data);
      swal({
          title: myarr["title"],
          text: myarr["selesai"],
          imageUrl: myarr["img"]
              },  function(){ 
        // location.reload();
		window.location = "http://assessment.tvip.co.id/essay/soal/startsoalmbti.php";


    });

	}

	});

	return false;  
		
});

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
