<?php
	// koneksi database
	$koneksi = mysqli_connect('localhost','root','','10118078__akademik');

	// mengambil data pengguna
	$data_pengguna = mysqli_query($koneksi,"SELECT * FROM t_user");
 	// menghitung data pengguna
	$jumlah_pengguna = mysqli_num_rows($data_pengguna);

	// mengambil data sopir
	$data_dsn = mysqli_query($koneksi,"SELECT * FROM t_dosen");
 	// menghitung data sopir
	$jumlah_dsn = mysqli_num_rows($data_dsn);

	// mengambil data armada
	$data_mhs = mysqli_query($koneksi,"SELECT * FROM t_mahasiswa");
 	// menghitung data armada
	$jumlah_mhs = mysqli_num_rows($data_mhs);

	// mengambil data jurusan
	$data_jsn = mysqli_query($koneksi,"SELECT * FROM t_jurusan");
 	// menghitung data jurusan
	$jumlah_jsn = mysqli_num_rows($data_jsn);

	// mengambil data jadwal
	$data_mtkl = mysqli_query($koneksi,"SELECT * FROM t_matkul");
 	// menghitung data jadwal
	$jumlah_mtkl = mysqli_num_rows($data_mtkl);

	// mengambil data transaksi
	$data_prklhn = mysqli_query($koneksi,"SELECT * FROM t_perkuliahan");
 	// menghitung data transaksi
	$jumlah_prklhn  = mysqli_num_rows($data_prklhn);
?>

<style type="text/css">
/*animasi gambar berputar*/
.metric span.icon {
  -webkit-transition: -webkit-transform 1.1s ease-in-out;
  transition: transform 1.1s ease-in-out;
}
.metric span.icon:hover {
  -webkit-transform: rotate(360deg);
  transform: rotate(360deg);
}
</style>

<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<!-- <p class="panel-subtitle">Selamat Datang, Admin</p> -->
							<!-- <?php
								// $tgl=date('l, d-m-Y');
								// echo $tgl;

								// date_default_timezone_set("Asia/Jakarta");
								// $b = time();
								// $hour = date("G",$b);

								// if ($hour>=0 && $hour<=11) {
								// 	$sapaan = "Selamat Pagi";
								// }
								// elseif ($hour >=12 && $hour<=14) {
								// 	$sapaan = "Selamat Siang";
								// }
								// elseif ($hour >=15 && $hour<=17) {
								// 	$sapaan = "Selamat Sore";
								// }
								// elseif ($hour >=17 && $hour<=18) {
								// 	$sapaan = "Selamat Petang";
								// }
								// elseif ($hour >=19 && $hour<=23) {
								// 	$sapaan = "Selamat Malam";
								// }
							?> -->
							<!-- <p class="panel-subtitle"><?php echo $sapaan; ?>, Admin</p> -->
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_pengguna; ?></span>
											<span class="title">Admin</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_dsn; ?></span>
											<span class="title">Dosen</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_mhs; ?></span>
											<span class="title">Mahasiswa</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-book"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_jsn; ?></span>
											<span class="title">Jurusan</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-book"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_mtkl; ?></span>
											<span class="title">Matakuliah</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-book"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_prklhn; ?></span>
											<span class="title">Perkuliahan</span>
										</p>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-9">
									<div id="headline-chart" class="ct-chart"></div>
								</div>
								<div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
										<span class="info-label">Total Sales</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
										<span class="info-label">Monthly Income</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
										<span class="info-label">Total Income</span>
									</div>
								</div>
							</div> -->
							<!-- <div class="row">
								<div class="col-md-9">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63419.61867940638!2d107.73012183565163!3d-6.556212036033797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693c919ece3ed5%3A0x630f121657291f0!2sSubang%2C%20Subang%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1592751006585!5m2!1sen!2sid" width="990" height="280" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
								</div>
							</div> -->
						</div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->
