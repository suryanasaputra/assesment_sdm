<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}
?>
<div class="col-sm-12">       
<h3 class="text-center"><strong>DATA SOAL DAN JAWABAN</strong></h3>
<br><br>
<div class="row btntambah">
  <div class="col-sm-2">
    <button class="btn btn-primary" data-toggle="modal" data-target="#tambah_soal">TAMBAH SOAL</button>
  </div>
</div>
    <table class="table table-hover table-bordered" id="dataku">
  <thead>
    <tr bgcolor="#fff">
      <th>No</th>
      <th style="width: 50%">Soal</th>
      <th>Jawaban</th>
      <th>Option</th>

    </tr>
  </thead>

  <tbody bgcolor="#fff">
    <?php 
    $no=1;
    $query = "SELECT * FROM soal";
    $result = mysqli_query($con, $query);
    while ($row=mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td><?=$no++; ?></td>
      <td><?=$row['soal'] ?></td>
      <td><?=$row['jawaban'] ?></td>
      <td>
        <a onclick="edit_soal('<?=$row['id'] ?>')" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#soal_edit">EDIT</a> | 
        <a onclick="hapus_soal('<?=$row['id'] ?>')" href="#" class="btn btn-xs btn-danger">HAPUS</a>
        <?php 
        $queryhitungjawab = "SELECT id FROM jawaban WHERE id_soal= '".$row['id']."' ";
        $result_hitung = mysqli_query($con,$queryhitungjawab);
        if (mysqli_num_rows($result_hitung) < 4) { ?> | 
        <a onclick="tambah_jawaban('<?=$row['id'] ?>')" data-toggle="modal" data-target="#tambah_jawaban" class="btn btn-xs btn-info">TAMBAH JAWABAN</a>
        <?php } ?>

      </td>
    </tr>
    <?php
  $query_jawab = "SELECT * FROM jawaban WHERE id_soal= '".$row['id']."'  ";
    $result_jawab = mysqli_query($con, $query_jawab);
    while ($row2=mysqli_fetch_assoc($result_jawab)) : ?>
    <tr>
      <td>*</td>
      <td><?=$row2['pilihan_jawab'] ?></td>
      <td></td>
      <td><a onclick="edit_jawaban('<?=$row2['id'] ?>')" data-toggle="modal" data-target="#jawaban_edit" class="btn btn-xs btn-warning">EDIT</a> | <a onclick="hapus_jawaban('<?=$row2['id'] ?>')" class="btn btn-xs btn-danger">HAPUS</a></td>
    </tr>


  <?php endwhile; ?>
  <?php endwhile; ?>
  </tbody>
</table>
  </div>

<script>
$(document).ready(function() {
$("#dataku").dataTable({

	"order": [],
"columnDefs": [ {
  "defaultContent": "-",
  "targets"  : 'no-sort',
  "targets": "_all",
  "orderable": false,
}]

});


});
</script>