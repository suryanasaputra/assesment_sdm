<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}
?>
<div class="row"> 
	<div id="isitabeluser">
		<div class="col-sm-12">      	
		<h3 class="text-center"><strong>DATA SCORE PILIHAN</strong></h1>
		<br><br>

        <table class="table table-hover table-bordered" id="dataku">
		  <thead>
		  	<tr bgcolor="#fff">
		  		<th width="20">No</th>
          <th>Nama</th>
          <th>Score</th>
          <th>Keterangan</th>

		  	</tr>
		  </thead>

		  <tbody bgcolor="#fff">
		  	<?php 
		  	$no=1;
		  	$query = "SELECT a.*, b.* FROM user_kuis a
                  INNER JOIN score b ON a.id = b.id
                  ORDER BY a.id ASC";
		  	$result = mysqli_query($con, $query);
		  	while ($row=mysqli_fetch_assoc($result)) : ?>
		  	<tr>
		  		<td><?=$no++; ?></td>
          <td><?=$row['usernama']?></td>
          <td><?=$row['score'] ?></td>
          <?php if($row['score'] != '')
            {?> <td> Selesai </td> <?php }
          else { ?> <td> Belum Selesai </td> <?php } ?>
		  	</tr>
		  
		  <?php endwhile; ?>
		  </tbody>
		</table>
      </div>
	</div>             
      

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

  function edit_user(id) {
    $('#isi_edituser').load('ajax/edit_user.php?id='+id);
  }

  function hapus_user(id) {
     swal({
      title: "Yakin akan menghapus?",
      text: "Data akan hilang jika dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, yakin!",
      cancelButtonText: "Tidak, biarkan saja!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
            url : "ajax/hapus_user.php",
            type: "POST",
            data: {id:id},
            success: function(data){
                swal("Berhasil!", "Data berhasil dihapus!", "success");
                $('#isitabeluser').load('ajax/isitabeluser.php');
            },
            error: function (jqXHR, textStatus, errorThrown){
                swal("Error !", "Error deleting data", "error");
            }
        });
        
      } else {
        swal("Cancel", "Data masih ada!", "error");
      }
    });
  }
 


  function saving_tambah_user(){
  	var url = "ajax/tambah_user.php";
        var formData = new FormData($('#form_tambah_user')[0]);
        if ($('#username').val()=='' || $('#password').val()=='') {
        	$('#tambah_user').modal('hide');
        	swal("Warning !", "Data belum lengkap!", "error");
        }else{
	        	$.ajax({
	            url : url,
	            type: "POST",
	            data: formData,
	            contentType: false,
	            processData: false,
	            dataType: "JSON",
	            success: function(data)
	            {

	                if(data.status) //if success
	                {
	                    
	                    $('#tambah_user').modal('hide');
	                    swal("Berhasil!", "Data berhasil ditambah!", "success");
	                    $('#isitabeluser').load('ajax/isitabeluser.php');
	                                        
	                }

	               
	                
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                swal("Error !", "Error added data", "error");
	                
	            }
	            
	        });
        }
        
  }
 
  function saving_user() {
    var url = "ajax/ubah_user.php";
        var formData = new FormData($('#form_edit_user')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success
                {
                    
                    $('#user_edit').modal('hide');
                    swal("Berhasil!", "Data berhasil diedit!", "success");
                    $('#isitabeluser').load('ajax/isitabeluser.php');
                                        
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Error !", "Error edit data", "error");
                
            }
            
        });

  }

  function generate (el) {
        el = document.getElementById(el);
        el.value = randomPass();
    }
  function randomPass () {
        return Math.random().toString(25).slice(-11);
    }

</script>