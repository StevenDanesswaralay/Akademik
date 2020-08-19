<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// transaksi.php
	// include models/model_transaksi.php
	include "../models/model_perkuliahan.php";
	$prklhn = new Perkuliahan ($connection);

	$id_perkuliahan = $_POST['id_perkuliahan'];
	$nilai = $connection->conn->real_escape_string($_POST['nilai']);

	$prklhn->edit("UPDATE t_perkuliahan SET nilai = '$nilai' WHERE id_perkuliahan = '$id_perkuliahan'");
	// redirect
	echo "<script>window.location='?page=perkuliahan';</script>";
?>
