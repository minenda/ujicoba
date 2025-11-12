<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Aplikasi Pendaftaran Santri Baru</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">User</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									<!--<button type="button" class="btn btn-white btn-icon-text my-2 me-2">
									  <i class="fe fe-download me-2"></i> Import
									</button>
									<button type="button" class="btn btn-white btn-icon-text my-2 me-2">
									  <i class="fe fe-filter me-2"></i> Filter
									</button>
									<button type="button" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fe fe-download-cloud me-2"></i> Download Report
									</button>-->
								</div>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-xl-3 col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-header">
										<h3 class="main-content-label">Ahlan Wa Sahlan !</h3>
									</div>
									<div class="card-body text-center item-user">
										<div class="profile-pic">
											<div class="profile-pic-img">
												<span class="bg-success dots" data-bs-toggle="tooltip" data-bs-placement="top" title="online"></span>
												<img src="../assets/img/users/1.jpg" class="rounded-circle" alt="user">
											</div>
											<a href="#" class="text-dark"><h5 class="mt-3 mb-0 font-weight-semibold"><?=$_SESSION['nama'];?></h5></a>
											<h6 class="text-dark mt-3 mb-0 font-weight-semibold"><b><?=$_SESSION['id_daftar'];?></b></h6>
										</div>
									</div>
									<ul class="item1-links nav nav-tabs  mb-0">
										<li class="nav-item">
											<a data-bs-target="#profile"  class="nav-link" data-bs-toggle="tab" role="tablist"><i class="ti-credit-card icon1"></i> Profil</a>
										</li>
										<li class="nav-item">
											<a data-bs-target="#whishlist" class="nav-link active" data-bs-toggle="tab" role="tablist"><i class="ti-heart icon1"></i> Data Pendaftar</a>
										</li>
										<li class="nav-item">
											<a href="../logout.php" class="nav-link"><i class="ti-power-off icon1"></i> Logout</a>
										</li>
									</ul>
								</div>
							</div>
