    <?php
    $id_daftar=$_SESSION['id_daftar'];
    
     if(isset($_POST['simpanDaftar'])){
        $nama_santri    = $_POST['nama_santri'];
        $jk             = $_POST['jk'];
        $tmp_lahir      = $_POST['tmp_lahir'];
        $tgl_lahir      = $_POST['tgl_lahir'];
        $asal_sekolah   = $_POST['asal_sekolah'];
        $prodi          = $_POST['prodi'];
        $nik            = $_POST['nik'];
        $nisn           = $_POST['nisn'];
        $tahunDaftar      = date('Y');
         $cek_user = mysqli_query($conn, "SELECT * FROM tbl_santri_baru WHERE nik='$nik'");
        //$run_query = mysqli_query($conn, $cek_user);
				if(mysqli_num_rows($cek_user) > 0){
				echo "<script>alert('NIK sudah digunakan! (Anda sudah pernah melakukan pendaftaran dengan NIK ini)')</script>";
                        echo "<script>window.open('daftar-mtw.php','_self')</script>";
                        exit();
                 } else {
                        //NIK belum digunakan dan buat no pendaftaran baru
                        $sql_urut = "SELECT MAX(RIGHT(no_daftar, 4)) AS no_max FROM tbl_santri_baru
                                    WHERE mid(no_daftar,1,4) = '$tahunDaftar'";
                        $data = mysqli_fetch_assoc(mysqli_query($conn, $sql_urut));
                          if (isset($data['no_max'])) {
                            //$data = mysqli_fetch_assoc($run_query2);
                            $temp = ((int)$data['no_max']) + 1;
                            $no   = sprintf("%04s", $temp);
							$m = date('m');
								$no_daftar = "$tahunDaftar"."$m"."$no";
                            //$no_daftar = $jk.$tahun_ajaran . $bln . $no;
                        } else {
								$m = date('m');
								$no_daftar = "$tahunDaftar"."$m"."0001";
                            //$no_daftar = $jk.$tahun_ajaran . $m."0001";
                        }
                        }
        $insert = mysqli_query($conn,"insert into tbl_santri_baru (id_pendaftar, no_daftar, nik, nisn, nama_santri, jk, tempat_lahir, tgl_lahir, asal_sekolah, prodi) values ('$id_daftar', '$no_daftar', '$nik', '$nisn', '$nama_santri','$jk', '$tmp_lahir', '$tgl_lahir', '$asal_sekolah', '$prodi')");
                        
                        	if($insert){
						
						echo "<script>alert('Registrasi Berhasil!');window.open('?page=listSantri','_self')</script>";
						}else{
							echo "<script>alert('Registrasi Gagal! Silahkan ulangi pengisian Form');window.open('?page=listSantri','_self')</script>";
						}
						
     }
     if(isset($_GET['ket'])){
        $noDaftar=$_GET['noDaftar'];
        if($_GET['ket']=='bayar') {
     $q1 = mysqli_query($conn,"update tbl_santri_baru set status = '1' where no_daftar = '$noDaftar'");
    if($q1){
		echo "<script>alert('Pembayaran akan kami proses. Mohon tunggu untuk notifikasi selanjutnya!');window.open('?page=Home','_self')</script>";
		}  else{
			echo "<script>alert('Registrasi Gagal! Silahkan ulangi pengisian Form');window.open('?page=Home','_self')</script>";
		} 
		}
     }
  ?>
        	<div class="col-xl-9 col-lg-12 col-md-12">
			    <div class="card custom-card">
				    <div class="card-body">
					    <div class="tab-content" id="myTabContent">
						    <div class="tab-pane fade show active" id="whishlist" role="tabpanel">
							    <div class="d-flex justify-content-between align-items-center mb-4">
								    <label class="main-content-label my-auto">Daftar Calon Santri</label>
								    <a class="btn ripple btn-success" data-bs-target="#ModalDaftar" data-bs-toggle="modal" href="" style="font-size:14px"><i class="ti ti-plus"></i> Daftar Baru</a>
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
											    <td><?php if($row['status']=='0'){?>
											    <a href="?page=Home&ket=bayar&noDaftar=<?=$row['no_daftar'];?>" type="button" class="btn btn-warning mb-1 me-1"><i class="ti-check me-2"></i> Bayar</a>
											    <?php } elseif($row['status']=='1'){?> 
											    <a href="" type="button" class="btn btn-success mb-1 me-1"><i class="ti-check me-2"></i>Proses</a>
											    <?php } elseif($row['status']=='2'){?> 
											    <a href="" type="button" class="btn btn-primary mb-1 me-1"><i class="ti-check me-2"></i>Lunas</a>
											    <?php }?> 
											    <?php if($row['status']=='2'){?>
												    <a class="btn ripple btn-success" href="?page=updateSantri&id=<?=$row['no_daftar'];?>" style="font-size:14px"><i class="ti ti-pencil"></i> Update</a>
											    <?php } else {?>
											    <button type="button" class="btn btn-primary mb-1 me-1" disabled><i class="ti-pencil me-2"></i>Update</button>
											    <?php } ?>
												    <button type="button" class="btn btn-danger mb-1"><i class="ti-trash me-2"></i>Hapus</button>
											    </td>
										    </tr><?php }?>
									    </tbody>
								    </table>
							    </div>
						    </div>
						
                    <br><br>
                    <div class="modal" id="ModalDaftar">
                        <div class="modal-dialog modal-lg col-10" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Pendaftaran Santri Baru</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                          
                                           <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label for="nama_santri">Nama Lengkap</label>
                                                    <input id="nama_santri" name="nama_santri" class="form-control" placeholder="Nama Lengkap" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input id="nik" name="nik" class="form-control" placeholder="" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nisn">NISN</label>
                                                    <input id="nisn" name="nisn" class="form-control" placeholder="" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jk">Laki-laki/Perempuan</label>
                                                    <select id="jk" name="jk" class="form-control" type="text" required>
                                                    <option>--pilih--</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tmp_lahir">Tempat lahir</label>
                                                    <input id="tmp_lahir" name="tmp_lahir" class="form-control" placeholder="Tempat lahir" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                                    <input id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Nama Ayah" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="asal_sekolah">Asal Sekolah</label>
                                                    <input id="asal_sekolah" name="asal_sekolah" class="form-control" placeholder="Sekolah asal" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prodi">Pilihan Prodi</label>
                                                    <select id="prodi" name="prodi" class="form-control" type="text" required>
                                                    <option>--pilih--</option>
                                                    <option value="MTW">MTW</option>
                                                    <option value="IL">IL</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <!--<div class="col-lg-6">
										    <div class="form-group">
                                                <label for="nama_file">Upload Foto</label>
                                                <input id="nama_file" name="nama_file" class="form-control" placeholder="alamat" type="file">
                                            </div>
                                            </div>-->
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button id="simpanDaftar" name="simpanDaftar" class="btn ripple btn-primary" type="submit">Simpan Data</button>
                                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
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
