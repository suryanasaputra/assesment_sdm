<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}
?>
<div class="col-sm-12">      	
<h3 class="text-center"><strong>DATA USER</strong></h3>
<br><br>
<div class="row btntambah">
	<div class="col-sm-2">
		<button class="btn btn-primary" data-toggle="modal" data-target="#tambah_user">TAMBAH USER</button>
	</div>
</div>
<table class="table table-hover table-bordered" id="dataku">
  <thead>
  	<tr bgcolor="#fff">
  		<th>No</th>
      <th>Nama</th>
  		<th>Username</th>
      <th>Password</th>
  		<th>Option</th>

  	</tr>
  </thead>

  <tbody bgcolor="#fff">
  	<?php 
  	$no=1;
  	$query = "SELECT * FROM user_kuis";
  	$result = mysqli_query($con, $query);
  	while ($row=mysqli_fetch_assoc($result)) : ?>
  	<tr>
  		<td><?=$no++; ?></td>
      <td><?=$row['usernama']?></td>
  		<td><?=$row['username'] ?></td>
      <td><?=$row['password'] ?></td>
  	<td>
    <a onclick="edit_user('<?=$row['id'] ?>')" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#user_edit">EDIT</a> | 
    <a onclick="hapus_user('<?=$row['id'] ?>')" href="#" class="btn btn-xs btn-danger">HAPUS</a>
    </td>
  	</tr>
  
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