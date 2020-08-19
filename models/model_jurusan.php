<?php
	class Jurusan {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data jurusan
		public function tampil($kode_jurusan= null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM t_jurusan";
			if($kode_jurusan != null) {
				$sql .= " WHERE kode_jurusan = $kode_jurusan";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data jurusan
		public function tambah($kode_jurusan,$nama_jurusan) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO t_jurusan VALUES('$kode_jurusan', '$nama_jurusan')") or die ($db_error);
		}

		// fungsi edit data jurusan
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data jurusan
		public function hapus($kode_jurusan) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM t_jurusan WHERE kode_jurusan = '$kode_jurusan'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>
