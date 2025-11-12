<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Program MTW</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #004d40, #0d6efd);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .card-form {
      max-width: 650px;
      width: 100%;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      overflow: hidden;
    }
    .card-header {
      background: linear-gradient(90deg, #004d40, #0d6efd);
      color: #fff;
      padding: 25px;
      text-align: center;
    }
    .card-header h3 {
      margin: 0;
      font-weight: bold;
    }
    .form-label {
      font-weight: 600;
      color: #333;
    }
    .btn-submit {
      background: linear-gradient(90deg, #0d6efd, #20c997);
      border: none;
      font-weight: 600;
    }
    .btn-submit:hover {
      background: linear-gradient(90deg, #20c997, #0d6efd);
    }
  </style>
</head>
<body>

<?php
include 'conn.php';
include 'pass.php';
if(isset($_POST['input'])){
$nama             = $_POST['nama'];
$jk               = $_POST['jenisKelamin'];
$alamat           = $_POST['alamat'];
$telp             = $_POST['telp'];
$email            = $_POST['email'];
$password         = $_POST['password'];
$passhash         = password_hash($password, PASSWORD_DEFAULT);
//$password         = password_hash($_POST['nik'], PASSWORD_DEFAULT);
$tahunDaftar      = date('Y');
                                             
        $cek_user = mysqli_query($conn, "SELECT * FROM tbl_pendaftar WHERE no_hp='$telp'");
        //$run_query = mysqli_query($conn, $cek_user);
				if(mysqli_num_rows($cek_user) > 0){
				echo "<script>alert('No HP sudah digunakan! (Anda sudah pernah melakukan pendaftaran dengan No HP ini)')</script>";
                        echo "<script>window.open('register.php','_self')</script>";
                        exit();
                 } else {
                        //NIK belum digunakan dan buat no pendaftaran baru
                        $sql_urut = "SELECT MAX(RIGHT(id_daftar, 4)) AS no_max FROM tbl_pendaftar
                                    WHERE mid(id_daftar,1,4) = '$tahunDaftar'";
                        $data = mysqli_fetch_assoc(mysqli_query($conn, $sql_urut));
                          if (isset($data['no_max'])) {
                            //$data = mysqli_fetch_assoc($run_query2);
                            $temp = ((int)$data['no_max']) + 1;
                            $no   = sprintf("%04s", $temp);
							$m = date('m');
							$id_daftar = "$tahunDaftar"."$m"."$no";
                            
                        } else {
								$m = date('m');
								$id_daftar = "$tahunDaftar"."$m"."0001";
                           
                        }
                               
				$insert = mysqli_query($conn, "INSERT INTO tbl_pendaftar(nama, jk, alamat, id_daftar, email, no_hp, passhash, password) VALUES ('$nama', '$jk', '$alamat', '$id_daftar', '$email', '$telp', '$passhash', '$password')");

						if($insert){
						echo "<script>alert('Registrasi Berhasil!');window.open('login.php','_self')</script>";
						}else{
							echo "<script>alert('Registrasi Gagal! Silahkan ulangi pengisian Form');window.open('register.php','_self')</script>";
						}
				}
}

?>

  <div class="card card-form">
    <div class="card-header">
      <h3><i class="bi bi-mortarboard"></i> Registrasi Pendaftaran Santri Baru</h3>
      <p class="mb-0">Ma'had Imam Bukhari Surakarta</p>
    </div>
    <div class="card-body p-4">
      <form method="post" name="formMtw" action="" class="form">
        <div class="mb-3">
          <label for="namaLengkap" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="mb-3">
          <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
          <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat Lengkap</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>
        <div class="mb-3">
          <label for="noHp" class="form-label">Nomor HP/WA</label>
          <input type="tel" class="form-control" id="telp" name="telp" placeholder="08xxxxxxxxxx" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Aktif</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com">
        </div>
        <div class="mb-4">
          <label for="prodi" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="">
        </div>
            <input type="hidden" class="form-control" id="noDaftar" name="noDaftar"required>
        <div class="d-grid">
          <button type="submit" name="input" class="btn btn-submit btn-lg text-white">
            <i class="bi bi-send-check"></i> Kirim Pendaftaran
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
