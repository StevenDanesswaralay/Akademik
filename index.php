<?php
 session_start();
 include 'inc/koneksi.php';

	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('controllers/koneksi.php');
	require_once('models/database.php');

	$connection = new Database($host, $user, $pass, $database);
if(@$_SESSION['admin'] || @$_SESSION['akademik']){
?>
<!doctype html>
<html lang="en">
<head>
	<title>Welcome | Akademik</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<!-- dataTables -->
	<link rel="stylesheet" href="assets/dataTables/datatables.min.css">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<h5> Akademik </h5>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<!-- <form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form> -->
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li> -->
						<li class="dropdown">
							<!-- menampilkan user pelogin sesuai jabatan_ptg -->
							<?php
								if(@$_SESSION['admin']) {
									$user_terlogin = @$_SESSION['admin'];
								} else if(@$_SESSION['akademik']) {
									$user_terlogin = @$_SESSION['akademik'];
								}
								// koneksi database
								$koneksi = mysqli_connect('localhost','root','','10118078__akademik');
								$sql_user = mysqli_query($koneksi, "SELECT * FROM t_user WHERE id_user = '$user_terlogin'") or die (mysqli_error());
								$data_user = mysqli_fetch_array($sql_user);
							?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span><?php echo $data_user['nama']; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<li><a href="inc/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
            <?php
            if(@$_SESSION['admin'] || @$_SESSION['akademik'] ){ ?>
						<li><a href="?page=dashboard" class=""> <span>Dashboard</span></a></li>
             <?php
              }?>
              <?php
              if(@$_SESSION['admin'] ||  @$_SESSION['akademik'] ){ ?>
						  <li><a href="?page=pengguna" class=""> <span>Petugas</span></a></li>
            <?php
             }?>
             <?php
             if(@$_SESSION['admin'] || @$_SESSION['akademik'] ){ ?>
						<li><a href="?page=dosen" class=""> <span>Dosen</span></a></li>
            <?php
             }?>
             <?php
             if(@$_SESSION['admin'] ||  @$_SESSION['akademik'] ){ ?>
						<li><a href="?page=mahasiswa" class=""> <span>Mahasiswa</span></a></li>
            <?php
             }?>
             <?php
             if(@$_SESSION['admin'] ||  @$_SESSION['akademik'] ){ ?>
           <li><a href="?page=jurusan" class=""> <span>Jurusan</span></a></li>
            <?php
             }?>
             <?php
             if(@$_SESSION['admin'] ||  @$_SESSION['akademik'] ){ ?>
           <li><a href="?page=matkul" class=""> <span>Matkul</span></a></li>
            <?php
             }?>
             <?php
             if(@$_SESSION['admin'] ||  @$_SESSION['akademik']){ ?>
           <li><a href="?page=perkuliahan" class=""> <span>Perkuliahan</span></a></li>
            <?php
             }?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->

		<!-- isi web dinamis -->
		<?php
			if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
				include "views/dashboard.php";
			} else if(@$_GET['page'] == 'pengguna') {
				include "views/pengguna.php";
			}  else if(@$_GET['page'] == 'dosen') {
				include "views/dosen.php";
			}  else if(@$_GET['page'] == 'mahasiswa') {
				include "views/mahasiswa.php";
			}  else if(@$_GET['page'] == 'jurusan') {
				include "views/jurusan.php";
			}  else if(@$_GET['page'] == 'matkul') {
				include "views/matkul.php";
			}  else if(@$_GET['page'] == 'perkuliahan') {
				include "views/perkuliahan.php";
			}
		?>
		<!-- isi web dinamis -->

		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Copyright 2020 <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">All Right Reserved</a></p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->

	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<!-- dataTables -->
	<script src="assets/dataTables/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#datatables').DataTable();
		});
	</script>
</body>
</html>
<?php
}else {
  header("location: login.php");
}
?>
