<?php 
  session_start();
  require "../../koneksi.php";
  if (!isset($_SESSION["login"])) {
    header("Location: ".base_url."login.php");
    exit;
  }

  $bataswaktu = 900;
  if (!isset($_SESSION["mulai_timestamp_ketelitian2"])) {
  $_SESSION["mulai_timestamp_ketelitian2"] = time();
  }
  $ts1 = $_SESSION["mulai_timestamp_ketelitian2"];
  $ts2 = time();     
  $seconds_diff = $ts2 - $ts1;           
  $_SESSION['mulai_kuis_ketelitian2'] = 'ya';
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
<section class="section is-medium ketelitian2" style="height: auto !important;">

  <center><div id="app"/></center>

  <div class="container">
    <div class="content has-text-centered mb-5">
    
    </div>
  </div>
  
<?php if(isset($_SESSION['mulai_ketelitian2']) == false) : ?> 
  <form id ="form_jawab" action="ajax/hasil4.php" method="post" accept-charset="utf-8" style="height: auto !important;">
    <?php
      $jawaban=array();
      $deskripsi_ketelitian = "SELECT a.*,b.jawaban_1 as jawab_1, b.jawaban_2 as jawab_2 FROM soal_ketelitian_2 as a left join score_ketelitian_2 as b on a.id = b.id_soal and b.id = ".$_SESSION['id']." ORDER BY RAND() ";
      // $deskripsi_ketelitian = "SELECT a.*,b.jawaban as jawaban_1  FROM soal_ketelitian_2 as a  left join score_ketelitian_2 as b on a.id = b.id_soal and b.id = ".$_SESSION['id']." ORDER BY RAND()";

      $result = mysqli_query($con, $deskripsi_ketelitian);
      while ($row=mysqli_fetch_assoc($result)) : ?>
      <br>
      <input type="hidden" name="id_soal" value="<?=$row['id']?>"/>
      <div id="box1">
        <div style="border: 1px solid;  padding: 5px; width: 90px; margin-left: auto; background-color:#85C1E9;">
          <div class="nomor">
            <label> SOAL <?=$row['id']?> </label>
          </div>
        </div>
        <br>
        <div id="box2">
          <table>
            <thead><tr>
              <td colspan="5">&nbsp;</td>
            </tr></thead>
            <tbody>
            <tr>
              <td><?php echo $row['deskripsi_ketelitian_a']; ?></td>
              <td><?php echo $row['deskripsi_ketelitian_b']; ?></td>
              <td><?php echo $row['deskripsi_ketelitian_c']; ?></td>
              <td><?php echo $row['deskripsi_ketelitian_d']; ?></td>
              <td><?php echo $row['deskripsi_ketelitian_e']; ?></td>
              <td><?php echo $row['deskripsi_ketelitian_f']; ?></td>
              <td class="jawaban">
                <input type="text" class="form-control" id="jawaban_1" name="jawaban_1<?=$row['id']?>" value="<?= $row['jawab_1']; ?>" 
                onchange="(function(){
                    updatedhasil();
                    return false;
                  })();return false;"
                />
            </td>
            <td class="jawaban">
                <input type="text" class="form-control" id="jawaban_2" name="jawaban_2<?=$row['id']?>"  value="<?= $row['jawab_2']; ?>" 
                onchange="(function(){
                    updatedhasil();
                    return false;
                  })();return false;"
                />
              </td>
              
            </tr>
                </tbody>
            </table>
            <br>
            
           
        </div> 
    </div>
    <?php endwhile; ?>
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
    window.location = "http://assessment.tvip.co.id/essay/soal/startsoalexcel.php";

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
        window.location = "http://assessment.tvip.co.id/essay/soal/startsoalexcel.php";

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

