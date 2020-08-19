<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// jurusan.php
	// include models/model_jurusan.php
	include "../models/model_jurusan.php";
	$jrsn = new Jurusan($connection);

	$kode_jurusan = $_POST['kode_jurusan'];
	$nama_jurusan = $connection->conn->real_escape_string($_POST['nama_jurusan ']);

	$jrsn->edit("UPDATE t_jurusan SET nama_jurusan  = '$nama_jurusan ' WHERE kode_jurusan = '$kode_jurusan'");
	// redirect
	echo "<script>window.location='?page=jurusan';</script>";
?>
