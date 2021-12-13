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
		<h3 class="text-center"><strong>DATA SCORE PERSONALITY PROFILE ASSESSMENT</strong></h1>
		<br><br>

<table class="table table-hover table-bordered" id="dataku">
		  <thead>
		  	<tr bgcolor="#fff">
		  		<th rowspan="2">No</th>
          <th rowspan="2">Nama</th>
          <th colspan="3">D</th>
          <th colspan="3">I</th>
          <th colspan="3">S</th>
          <th colspan="3">C</th>
          <th colspan="3">*</th>
		  	</tr>
        <tr bgcolor="#fff">
          <th>M</th>
          <th>L</th>
          <th style="background-color: #63F172;">CHG</th>
          <th>M</th>
          <th>L</th>
          <th style="background-color: #63F172;">CHG</th>
          <th>M</th>
          <th>L</th>
          <th style="background-color: #63F172;">CHG</th>
          <th>M</th>
          <th>L</th>
          <th style="background-color: #63F172;">CHG</th>
          <th>M</th>
          <th>L</th>
          <th style="background-color: #63F172;">CHG</th>
        </tr>
		  </thead>

   		  <tbody bgcolor="#fff">
		  	<?php 
		  	$no=1;
        $query_1 = "SELECT a.id, b.usernama FROM score_disc a
                    INNER JOIN user_kuis b ON a.id = b.id 
                    GROUP BY a.id";
        $result_1 = mysqli_query($con, $query_1);
        while ($row_1=mysqli_fetch_assoc($result_1)) :
        $query_2 = "SELECT COUNT(jawaban_disc_m) AS MOST_D
                    FROM score_disc 
                    WHERE jawaban_disc_m ='D' AND id ='".$row_1['id']."' ";
        $result_2 = mysqli_query($con, $query_2);
        while ($row_2=mysqli_fetch_assoc($result_2)) : 
        $query_3 = "SELECT COUNT(jawaban_disc_l) AS LEAST_D
                    FROM score_disc 
                    WHERE jawaban_disc_l ='D' AND id ='".$row_1['id']."' ";
        $result_3 = mysqli_query($con, $query_3);
        while ($row_3=mysqli_fetch_assoc($result_3)) :
        $query_4 = "SELECT COUNT(jawaban_disc_m) AS MOST_I
                    FROM score_disc 
                    WHERE jawaban_disc_m ='I' AND id ='".$row_1['id']."' ";
        $result_4 = mysqli_query($con, $query_4);
        while ($row_4=mysqli_fetch_assoc($result_4)) : 
        $query_5 = "SELECT COUNT(jawaban_disc_l) AS LEAST_I
                    FROM score_disc 
                    WHERE jawaban_disc_l ='I' AND id ='".$row_1['id']."' ";
        $result_5 = mysqli_query($con, $query_5);
        while ($row_5=mysqli_fetch_assoc($result_5)) :
        $query_6 = "SELECT COUNT(jawaban_disc_m) AS MOST_S
                    FROM score_disc 
                    WHERE jawaban_disc_m ='S' AND id ='".$row_1['id']."' ";
        $result_6 = mysqli_query($con, $query_6);
        while ($row_6=mysqli_fetch_assoc($result_6)) : 
        $query_7 = "SELECT COUNT(jawaban_disc_l) AS LEAST_S
                    FROM score_disc 
                    WHERE jawaban_disc_l ='S' AND id ='".$row_1['id']."' ";
        $result_7 = mysqli_query($con, $query_7);
        while ($row_7=mysqli_fetch_assoc($result_7)) :
        $query_8 = "SELECT COUNT(jawaban_disc_m) AS MOST_C
                    FROM score_disc 
                    WHERE jawaban_disc_m ='C' AND id ='".$row_1['id']."' ";
        $result_8 = mysqli_query($con, $query_8);
        while ($row_8=mysqli_fetch_assoc($result_8)) :
        $query_9 = "SELECT COUNT(jawaban_disc_l) AS LEAST_C
                    FROM score_disc 
                    WHERE jawaban_disc_l ='C' AND id ='".$row_1['id']."' ";
        $result_9 = mysqli_query($con, $query_9);
        while ($row_9=mysqli_fetch_assoc($result_9)) :
        $query_10 = "SELECT COUNT(jawaban_disc_m) AS MOST_0
                    FROM score_disc 
                    WHERE jawaban_disc_m ='0' AND id ='".$row_1['id']."' ";
        $result_10 = mysqli_query($con, $query_10);
        while ($row_10=mysqli_fetch_assoc($result_10)) :
        $query_11 = "SELECT COUNT(jawaban_disc_l) AS LEAST_0
                    FROM score_disc 
                    WHERE jawaban_disc_l ='0' AND id ='".$row_1['id']."' ";
        $result_11 = mysqli_query($con, $query_11);
        while ($row_11=mysqli_fetch_assoc($result_11)) : ?>
		  	<tr>
	        <td><?=$no++; ?></td>
          <td><?=$row_1['usernama']?></td>
          <td><?=$row_2['MOST_D']?></td>
          <td><?=$row_3['LEAST_D']?></td>
          <td style="background-color: #63F172;"><?=$row_2['MOST_D'] - $row_3['LEAST_D']?></td>
          <td><?=$row_4['MOST_I']?></td>
          <td><?=$row_5['LEAST_I']?></td>
          <td style="background-color: #63F172;"><?=$row_4['MOST_I'] - $row_5['LEAST_I']?></td>
          <td><?=$row_6['MOST_S']?></td>
          <td><?=$row_7['LEAST_S']?></td>
          <td style="background-color: #63F172;"><?=$row_6['MOST_S'] - $row_7['LEAST_S']?></td>
          <td><?=$row_8['MOST_C']?></td>
          <td><?=$row_9['LEAST_C']?></td>
          <td style="background-color: #63F172;"><?=$row_8['MOST_C'] - $row_9['LEAST_C']?></td>
          <td><?=$row_10['MOST_0']?></td>
          <td><?=$row_11['LEAST_0']?></td>
          <td style="background-color: #63F172;"><?=$row_10['MOST_0'] - $row_11['LEAST_0']?></td>
		  	</tr>
		  
		  <?php 
      endwhile;
      endwhile;
      endwhile;
      endwhile;
      endwhile;
      endwhile;
      endwhile;
      endwhile; 
      endwhile;
      endwhile;
      endwhile; ?>
		  </tbody> 
</table>
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