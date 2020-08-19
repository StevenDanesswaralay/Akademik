<?php
	class Matkul {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data matkul
		public function tampil($kode_mk = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM t_matkul";
			if($kode_mk != null) {
				$sql .= " WHERE kode_mk = $kode_mk";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data matkul
		public function tambah($kode_mk, $nama_mk ,$sks, $semester) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO t_matkul VALUES('$kode_mk','$nama_mk','$sks','$semester')") or die ($db_error);
		}

		// fungsi edit data matkul
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data matkul
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM t_matkul WHERE kode_mk = '$kode_mk'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>
