<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// dosen.php
	// include models/model_dosen.php
	include "../models/model_dosen.php";
	$dsn = new Dosen($connection);

	$nip = $_POST['nip'];
	$nama_dosen = $connection->conn->real_escape_string($_POST['nama_dosen']);
	$jk  = $connection->conn->real_escape_string($_POST['jk']);
	$tgl_lahir  = $connection->conn->real_escape_string($_POST['tgl_lahir']);
	$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
	$alamat = $connection->conn->real_escape_string($_POST['alamat']);

	$dsn->edit("UPDATE t_dosen SET nama_dosen = '$nama_dosen', jk = '$jk', tgl_lahir = '$tgl_lahir',no_telp = '$no_telp', alamat = '$alamat'  WHERE nip = '$nip'");
	// redirect
	echo "<script>window.location='?page=dosen';</script>";
?>
