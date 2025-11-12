    <?php
    $id_daftar=$_SESSION['id_daftar'];
    $sql = mysqli_query($conn, "select * from tbl_pendaftar where id_daftar='$id_daftar'");
    $data=mysqli_fetch_array($sql);
    if(isset($_POST['btnSimpan'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHP'];
    $email = $_POST['email'];
    $s = mysqli_query($conn,"update tbl_pendaftar set nama='$nama', alamat='$alamat', no_hp='$noHP', email='$email'");
    if($s) {
    echo "<script>alert('Data Profil Berhasil diupdate!'); window.location = '?page=Home'</script>";
    } else {
     echo "<script>alert('Data Profil gagal diupdate!'); window.location = '?page=Home'</script>";
     }
     }
    ?>
    		<div class="col-xl-9 col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade" id="whishlist" role="tabpanel">
												<div class="d-flex justify-content-between align-items-center mb-4">
													<label class="main-content-label my-auto">Daftar Calon Santri</label>
													<a href="?page=tambahDaftar" type="button" class="btn btn-success mb-1 me-1"><i class="ti-plus me-2"></i>Tambah Baru</button>
												</div>
												<div class="table-responsive">
													<table class="table border text-nowrap">
														<thead>
															<tr>
																<th>#</th>
																<th>Photo</th>
																<th>Nama Santri</th>
																<th>L/P</td>
																<th>Tgl Lahir</th>
																<th>Tmpt Lahir</th>
																<th>Asal Sekolah</th>
																<th>Prodi</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
						<?php
						$no=1;
						$sql=mysqli_query($conn,"select * from tbl_santri_baru where id_pendaftar='$id_daftar'");
						while($row=mysqli_fetch_array($sql)){
						
						?>
															<tr>
																<td><?=$no++;?>
																<td><img src="../assets/img/pngs/14.png" class="img-sm product-image border" alt="product-img"></td>
																<td><?=$row['nama_santri'];?></td>
																<td><?=$row['jk'];?></td>
																<td><?=$row['tgl_lahir'];?></td>
																<td><?=$row['tempat_lahir'];?></td>
																<td><?=$row['asal_sekolah'];?></td>
																<td><?=$row['prodi'];?></td>
																<td>
																    <button type="button" class="btn btn-success mb-1 me-1"><i class="ti-check me-2"></i>Kirim</button>
																	<button type="button" class="btn btn-primary mb-1 me-1"><i class="ti-pencil me-2"></i>Edit</button>
																	<button type="button" class="btn btn-danger mb-1"><i class="ti-trash me-2"></i>Hapus</button>
																</td>
															</tr><?php }?>
														</tbody>
													</table>
												</div>
											</div>
											
											<div class="tab-pane fade show active" id="profile" role="tabpanel">
											    <form class="form" method="post" action="" id="formProfil">
												<div class="d-flex align-items-start pb-3 border-bottom"> <img src="../assets/img/users/1.jpg" class="img rounded-circle avatar-xl" alt="">
													<div class="ps-sm-4 ps-2" id="img-section"> <b>Foto Profil</b>
														<p class="mb-1">Accepted file type .png. Less than 1MB</p> <input id="nama_file" name="nama_file" class="btn ripple" type="file"><button id="uplFoto" name="uplFoto" class="btn btn-xs btn-warning" type="submit">Upload</button>
													</div>
												</div>
												<div class="py-2">
													<div class="row py-2">
														<div class="col-md-6"> <label id="last-name">Nama</label> <input type="text" id="nama" name="nama" class="form-control" value="<?=$data['nama'];?>" readonly></div>
														<div class="col-md-6 pt-md-0 pt-3"> <label id="last-name">No HP</label> <input type="text" class="form-control" name="noHP" value="<?=$data['no_hp'];?>" readonly> </div>
													</div>
													<div class="row py-2">
														<div class="col-md-6"> <label id="tempat_lahir">Alamat</label> <input type="text" name="alamat" class="form-control" value="<?=$data['alamat'];?>" readonly> </div>
														<div class="col-md-6 pt-md-0 pt-3"> <label id="phoneno">Email</label> <input type="text" name="email" class="form-control" value="<?=$data['email'];?>" readonly> </div>
													</div>
													
														<br>
														 <div class="text-center mt-3">
                                                            <button type="button" id="btnEdit" class="btn btn-primary">Update</button>
                                                            <button type="submit" id="btnSimpan" name="btnSimpan" class="btn btn-warning" disabled>Simpan</button>
                                                          </div>
														</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
