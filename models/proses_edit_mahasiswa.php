<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// sopir.php
	// include models/model_mahasiswa.php
	include "../models/model_mahasiswa.php";
	$mhs = new Mahasiswa($connection);

	$nim= $_POST['nim'];
	$nama_mhs = $connection->conn->real_escape_string($_POST['nama_mhs']);
	$jk = $connection->conn->real_escape_string($_POST['jk']);
	$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
	$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
  $alamat  = $connection->conn->real_escape_string($_POST['alamat']);
	$kode_jurusan = $connection->conn->real_escape_string($_POST['kode_jurusan']);

	$mhs->edit("UPDATE t_mahasiswa SET nama_mhs = '$nama_mhs', kode_jurusan = '$kode_jurusan', jk  = '$jk', tgl_lahir = '$tgl_lahir',no_telp = '$no_telp',alamat = '$alamat' WHERE nim = '$nim' ");
	// redirect
	echo "<script>window.location='?page=mahasiswa';</script>";
?>
