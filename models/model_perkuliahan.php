<?php
	class Perkuliahan {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data transaksi
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM t_perkuliahan";
			if($id != null) {
				$sql .= " WHERE id_perkuliahan = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data transaksi
		public function tambah($nim, $kode_mk, $nip, $nilai) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO t_perkuliahan VALUES('', '$nim','$kode_mk','$nip','$nilai')") or die ($db_error);
		}

		// fungsi edit data transaksi
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// // fungsi hapus data jadwal
		// public function hapus($id) {
		// 	$db = $this->mysqli->conn;
		// 	$db->query("DELETE FROM tb_jadwal WHERE id_jadwal = '$id'") or die ($db_error);
		// }

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>
