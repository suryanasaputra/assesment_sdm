<?php 
  session_start();
  require "../../koneksi.php";
  if (!isset($_SESSION["login"])) {
    header("Location: ".base_url."login.php");
    exit;
  }

  $bataswaktu = 600;
  if (!isset($_SESSION["mulai_timestamp_mbti"])) {
  $_SESSION["mulai_timestamp_mbti"] = time();
  }
  $ts1 = $_SESSION["mulai_timestamp_mbti"];
  $ts2 = time();     
  $seconds_diff = $ts2 - $ts1;           
  $_SESSION['mulai_kuis_mbti'] = 'ya';
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

<section class="section mbti is-medium" style="height: auto !important;">

  <center><div id="app" /></center>  

  <div class="container">
    <div class="content has-text-centered mb-5">
      
    </div>

  <?php if(isset($_SESSION['mulai_mbti']) == false) : ?>           
  <form id ="form_jawab" action="ajax/hasil5.php" method="post" accept-charset="utf-8" style="height: auto !important;">
  
      <div id="box1" class="container">
        <div class="row">
  <?php 
          $records = mysqli_query($con, "SELECT a.*,if(b.jawaban = a.jawaban_mbti,'checked','') as checked from (
            SELECT `id`,`deskripsi_mbti_a` as deskripsi_mbti, `jawaban_mbti_a` as jawaban_mbti,`tipe_mbti_a` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_b` as deskripsi_mbti, `jawaban_mbti_b` as jawaban_mbti,`tipe_mbti_b` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_c` as deskripsi_mbti, `jawaban_mbti_c` as jawaban_mbti,`tipe_mbti_c` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_d` as deskripsi_mbti, `jawaban_mbti_d` as jawaban_mbti,`tipe_mbti_d` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_e` as deskripsi_mbti, `jawaban_mbti_e` as jawaban_mbti,`tipe_mbti_e` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_f` as deskripsi_mbti, `jawaban_mbti_f` as jawaban_mbti,`tipe_mbti_f` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_g` as deskripsi_mbti, `jawaban_mbti_g` as jawaban_mbti,`tipe_mbti_g` as tipe_mbti FROM soal_mbti
              UNION ALL
             SELECT `id`,`deskripsi_mbti_h` as deskripsi_mbti, `jawaban_mbti_h` as jawaban_mbti,`tipe_mbti_h` as tipe_mbti FROM soal_mbti ) as a left join score_mbti as b on b.id_soal = a.id and b.tipe_mbti = a.tipe_mbti and b.id = ".$_SESSION['id']."
             ORDER BY a.tipe_mbti, a.id;");
             $even = true;
          while ($project =  mysqli_fetch_assoc($records)): ?>
          <?php if($even) : ?>
          <div class="col-xs-5 even">
            <div class="row">
            <?php if($project['id'] == 1) :?>
              <div class="col-xs-12"><strong><?php echo $project['jawaban_mbti']; ?></strong></div>
              <?php endif; ?>  
              <div class="col-xs-2"><input 
                  type="radio" 
                  id="jawaban_mbti_<?=$project['id']?>_<?=$project['jawaban_mbti']; ?>"  
                  name="jawaban_mbti_<?=$project['id']?>[<?=$project['tipe_mbti'];?>]"  
                  value="<?=$project['jawaban_mbti']; ?>"
                  required 
                  onclick="(function(){
                    updatedhasil();
                  })(event)" <?=$project['checked']; ?> /></div>
                <div class="col-xs-10"><?php echo $project['deskripsi_mbti']; ?></div>  
            </div>
          </div>
          <div class="col-xs-2"><?php echo $project['id']; ?></div>
          <?php else : ?>
            <div class="col-xs-5 odd">
            <div class="row">
            <?php if($project['id'] == 1) :?>
              <div class="col-xs-12"><strong><?php echo $project['jawaban_mbti']; ?></strong></div>
              <?php endif; ?>
              <div class="col-xs-10"><?php echo $project['deskripsi_mbti']; ?></div>    
              <div class="col-xs-2"><input 
                  type="radio" 
                  id="jawaban_mbti_<?=$project['id']?>_<?=$project['jawaban_mbti']; ?>"  
                  name="jawaban_mbti_<?=$project['id']?>[<?=$project['tipe_mbti'];?>]"  
                  value="<?=$project['jawaban_mbti']; ?>"
                  required 
                  onclick="(function(){
                    updatedhasil();
                  })(event)" <?=$project['checked']; ?> /></div>
            </div>
          </div>
          <?php endif; 
            $even = !$even;
          ?>
          <?php endwhile;?>
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
    // location.reload();
    window.location = "http://assessment.tvip.co.id/essay/soal/startsoalketelitian1.php";
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
        window.location = "http://assessment.tvip.co.id/essay/soal/startsoalketelitian1.php";

    });

  }

  });

  return false;  
    
});

</script>

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
    $("#form_jawab").submit();
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



