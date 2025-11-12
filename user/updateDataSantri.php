<?php
$noDaftar=$_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_santri_baru where no_daftar = '$noDaftar'"));

?>
<div class="col-xl-9 col-lg-12 col-md-12">
	<div class="card custom-card">
		<div class="card-body">
				<!--Awal content di sini-->   
				
			<form class="form" method="post" action="" id="formProfil">
				<div class="d-flex align-items-start pb-3 border-bottom"> <img src="../assets/img/users/1.jpg" class="img rounded-circle avatar-xl" alt="">
					<div class="ps-sm-4 ps-2" id="img-section"> <b>Foto Profil</b>
						<p class="mb-1">Accepted file type .png. Less than 1MB</p> <input id="nama_file" name="nama_file" class="btn ripple" type="file"><button id="uplFoto" name="uplFoto" class="btn btn-xs btn-warning" type="submit">Upload</button>
					</div>
				</div>
				<div class="py-2">
				<label class="main-content-label badge bg-primary"><h6><b>Data Pribadi Calon Santri</b></h6></label>
					<div class="row py-2">
						<div class="col-md-6"> 
						    <label id="last-name">Nama Santri</label> 
						    <input type="text" id="nama_santri" name="nama_santri" class="form-control" value="<?=$data['nama_santri'];?>" readonly>
						</div>
						<div class="col-md-6 pt-md-0 pt-3"> 
						    <label id="last-name">No Daftar</label> 
						    <input type="text" class="form-control" name="noDaftar" value="<?=$data['no_daftar'];?>" readonly> 
						</div>
						<div class="col-md-6 pt-md-0 pt-3"> 
						    <label id="last-name">NIK</label> 
						    <input type="text" id="nama" name="nama" class="form-control" value="<?=$data['nama_santri'];?>" readonly>
						</div>
						<div class="col-md-6 pt-md-0 pt-3"> 
						    <label id="last-name">No HP</label> 
						    <input type="text" class="form-control" name="noHP" value="<?=$data['no_hp'];?>" readonly>
						</div>
					</div><br><br>
					<label class="main-content-label badge bg-primary"><h6><b>Data Ayah</b></h6></label>
			        <div class="row py-2">
				        <div class="col-md-6"> 
				            <label id="tempat_lahir">Alamat</label> 
				            <input type="text" name="alamat" class="form-control" value="<?=$data['alamat'];?>" readonly> 
				        </div>
				        <div class="col-md-6 pt-md-0 pt-3"> 
				            <label id="phoneno">Email</label> 
				            <input type="text" name="email" class="form-control" value="<?=$data['email'];?>" readonly> 
				        </div>
				        <div class="col-md-6 pt-md-0 pt-3"> 
				            <label id="phoneno">Email</label> 
				            <input type="text" name="email" class="form-control" value="<?=$data['email'];?>" readonly> 
				        </div>
				        <div class="col-md-6 pt-md-0 pt-3"> 
				            <label id="phoneno">Email</label> 
				            <input type="text" name="email" class="form-control" value="<?=$data['email'];?>" readonly> 
				        </div>
			        </div>
				        <br>
		            <div class="text-center mt-3">
                        <button type="button" id="btnEdit" class="btn btn-primary">Update</button>
                        <button type="submit" id="btnSimpan" name="btnSimpan" class="btn btn-warning" disabled>Simpan</button>
                     </div>
				 </div>
			</form>
				<!--Akhir content di sini-->
		</div>
	</div>
</div>
									 
<!-- End Main Content-->
<?php include "footer.php";?>
<script>
$(document).ready(function() {
  $('#btnEdit').on('click', function() {
    const isEditing = $(this).text() === 'Batal';
    if (isEditing) {
      // Kembalikan ke readonly
      $('#formProfil').find('input, textarea').attr('readonly', true);
      $('#btnSimpan').prop('disabled', true);
      $(this).text('Update').removeClass('btn-danger').addClass('btn-primary');
    } else {
      // Aktifkan edit
      $('#formProfil').find('input, textarea').removeAttr('readonly');
      $('#btnSimpan').prop('disabled', false);
      $(this).text('Batal').removeClass('btn-primary').addClass('btn-danger');
    }
  });
});
</script>		
		
