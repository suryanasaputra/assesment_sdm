<?php 
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["login"]) || $_SESSION['user'] != 'admin' && $_SESSION['user'] != 'sigit') {
  header("Location: ".base_url."login.php");
  exit;
}
?>
<div class="row"> 
	<div id="isitabel">
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
            <a onclick="hapus_soal('<?=$row['id'] ?>')"class="btn btn-xs btn-danger">HAPUS</a>
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
		  		<td><a onclick="edit_jawaban('<?=$row2['id'] ?>')" data-toggle="modal" data-target="#jawaban_edit" class="btn btn-xs btn-warning">EDIT</a> | 
              <a onclick="hapus_jawaban('<?=$row2['id'] ?>')" class="btn btn-xs btn-danger">HAPUS</a></td>
		  	</tr>

			<?php endwhile; ?>
		  <?php endwhile; ?>

		  </tbody>
		</table>
      </div>
	</div>             
      

</div>


<!-- Modal edit soal-->
<div class="modal fade" id="soal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>EDIT SOAL</strong></h4>
      </div>
      <div class="modal-body" id="isi_editsoal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-primary" onclick="saving_soal()">SAVE CHANGES</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal editsoal -->

<!-- Modal edit jawaban-->
<div class="modal fade" id="jawaban_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>EDIT JAWABAN</strong></h4>
      </div>
      <div class="modal-body" id="isi_editjawaban">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-primary" onclick="saving_jawaban()">SAVE CHANGES</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal editjawaban -->

<!-- Modal tambah soal-->
<div class="modal fade" id="tambah_soal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>TAMBAH SOAL</strong></h4>
      </div>
      <div class="modal-body">
      	<form id="form_tambah_soal">
		  <div class="form-group">
		    <label for="soal">Soal</label>
		    <textarea name="soal" id="soal" cols="30" rows="10" class="form-control" placeholder="Isikan Soal"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="jawaban">Jawaban</label>
		    <input type="text" class="form-control" id="jawaban" name="jawaban" placeholder="Isikan Jawaban">
		  </div>
      <button type="reset" class="btn btn-danger">RESET</button>
		</form>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-primary" onclick="saving_tambah_soal()">SAVE</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal tambahsoal -->

<!-- Modal tambah jawaban-->
<div class="modal fade" id="tambah_jawaban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">TAMBAH JAWABAN</h4>
      </div>
      <div class="modal-body">
      	<form id="form_tambah_jawaban">		  
		  <div class="form-group">
		    <label for="jawaban">Jawaban</label>
		    <input type="hidden" class="form-control" id="id_soal" name="id_soal">
		    <input type="text" class="form-control" id="pilihan_jawab" name="pilihan_jawab" required placeholder="Jawaban">
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-primary" onclick="saving_tambah_jawaban()">SAVE</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal tambahsoal -->


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

  function edit_soal(id) {
    $('#isi_editsoal').load('ajax/edit_soal.php?id='+id);
  }

 function edit_jawaban(id) {
    // alert(id);
    $('#isi_editjawaban').load('ajax/edit_jawaban.php?id='+id);
  }

  function hapus_soal(id) {
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
            url : "ajax/hapus_soal.php",
            type: "POST",
            data: {id:id},
            success: function(data){
                swal("Berhasil!", "Data berhasil didelete!", "success");
                $('#isitabel').load('ajax/isitabel.php');
            },
            error: function (jqXHR, textStatus, errorThrown){
                swal("Error !", "Error deleting data!", "error");
            }
        });
        
      } else {
        swal("Cancel", "Data masih ada", "error");
      }
    });
  }
 

   function hapus_jawaban(id) {
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
            url : "ajax/hapus_jawaban.php",
            type: "POST",
            data: {id:id},
            success: function(data){
                swal("Berhasil!", "Data berhasil didelete!", "success");
                $('#isitabel').load('ajax/isitabel.php');
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


  function saving_tambah_soal(){
  	var url = "ajax/tambah_soal.php";
        var formData = new FormData($('#form_tambah_soal')[0]);
        if ($('#soal').val()=='' || $('#jawaban').val()=='') {
        	$('#tambah_soal').modal('hide');
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
	                    
	                    $('#tambah_soal').modal('hide');
	                    swal("Berhasil!", "Data berhasil ditambah!", "success");
	                    $('#isitabel').load('ajax/isitabel.php');
	                                        
	                }

	               
	                
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                swal("Error !", "Error added data", "error");
	                
	            }
	            
	        });
        }
        
  }
 
function tambah_jawaban(id){
  $('#form_tambah_jawaban')[0].reset();
	$('#id_soal').val(id);
}
 function saving_tambah_jawaban(){
  		var url = "ajax/tambah_jawaban.php";
        var formData = new FormData($('#form_tambah_jawaban')[0]);
        if ($('#pilihan_jawab').val()=='') {
        	$('#tambah_jawaban').modal('hide');
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
	                    
	                    $('#tambah_jawaban').modal('hide');
	                    swal("Berhasil!", "Data berhasil ditambah!", "success");
	                    $('#isitabel').load('ajax/isitabel.php');
	                                        
	                }

	               
	                
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                swal("Error !", "Error added data", "error");
	                
	            }
	            
	        });
        }
        
  }

  function saving_soal() {
    var url = "ajax/ubah_soal.php";
        var formData = new FormData($('#form_edit_soal')[0]);
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
                    
                    $('#soal_edit').modal('hide');
                    swal("Berhasil!", "Data berhasil diubah!", "success");
                    $('#isitabel').load('ajax/isitabel.php');
                                        
                }

               
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Error !", "Error edit data", "error");
                
            }
            
        });

  }

  function saving_jawaban() {
    var url = "ajax/ubah_jawaban.php";
        var formData = new FormData($('#form_edit_jawaban')[0]);
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
                    
                    $('#jawaban_edit').modal('hide');
                    swal("Berhasil!", "Data berhasil diubah!", "success");
                    $('#isitabel').load('ajax/isitabel.php');
                                        
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Error !", "Error edit data", "error");
                
            }
            
        });

  }

</script>