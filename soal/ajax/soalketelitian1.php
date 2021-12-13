<?php 
  session_start();
  require "../../koneksi.php";
  if (!isset($_SESSION["login"])) {
    header("Location: ".base_url."login.php");
    exit;
  }
  
  $bataswaktu = 600;
  
  if (!isset($_SESSION["mulai_timestamp_ketelitian1"])) {
  $_SESSION["mulai_timestamp_ketelitian1"] = time();
  }
  $ts1 = $_SESSION["mulai_timestamp_ketelitian1"];
  $ts2 = time();     
  $seconds_diff = $ts2 - $ts1;           
  $_SESSION['mulai_kuis_ketelitian1'] = 'ya';
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
  
<?php if(isset($_SESSION['mulai_ketelitian1']) == false) : ?> 
  <form id ="form_jawab" action="ajax/hasil3.php" method="post" accept-charset="utf-8" style="height: auto !important;">
    <?php
      $jawaban=array();
      $deskripsi_ketelitian = "SELECT a.*,b.jawaban as jawaban_score  FROM soal_ketelitian_1 as a  left join score_ketelitian_1 as b on a.id = b.id_soal and b.id = ".$_SESSION['id']." ORDER BY RAND()";
      // $deskripsi_ketelitian =  "SELECT * FROM  soal_ketelitian_1 WHERE id ORDER BY RAND ()"; 

      
      $result = mysqli_query($con, $deskripsi_ketelitian);
    ?>
    <center>
    <div class="container">
      <div class="row panel panel-default" style="padding: 50px 35px">
        <?php while ($row=mysqli_fetch_assoc($result)) :  ?>
          <div class="col-sm-4" style="margin-bottom: 10px;">
            <div class="row">
              <input type="hidden" name="id_soal" value="<?=$row['id']?>"/>
              <input type="hidden" name="jawaban<?=$row['id']?>" id="form_<?=$row['id']?>" value="<?=$row['jawaban_score'] ?>"/>
              <div class="col-sm-3">  
                <?=$row['deskripsi_ketelitian_a']; ?>
              </div>
              <div class="col-sm-3">
                <?=$row['deskripsi_ketelitian_b']; ?>
              </div>
              <div class="col-sm-6" id="jawaban<?=$row['id']?>">
           <?php if(!$row['jawaban_score']) : ?>
                <button 
                  class="btn btn-primary"
                  onClick="(function(){
                    $('#form_<?=$row['id']?>').val('B');
                    $('#jawaban<?=$row['id']?>').html('<b>BENAR</b>');
                    
                    updatedhasil();
                    return false;
                  })();return false;"
                  >
                  B
                </button>
                <button 
                  class="btn btn-danger"
                  onClick="(function(){
                    $('#form_<?=$row['id']?>').val('S');
                    $('#jawaban<?=$row['id']?>').html('<b>SALAH</b>');
                    
                    updatedhasil();
                    return false;
                  })();return false;"
                  >
                  S
                </button>
                <?php else: ?>
                <b><?php echo $row['jawaban_score'] == 'B' ? 'BENAR': 'SALAH' ; ?></b>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
          </div>
        </div>
      </div>
    </center>

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
    window.location = "http://assessment.tvip.co.id/essay/soal/startsoalketelitian2.php";

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
        window.location = "http://assessment.tvip.co.id/essay/soal/startsoalketelitian2.php";

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
