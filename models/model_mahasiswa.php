<?php
	class Mahasiswa {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data dosen
		public function tampil($nim = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM t_mahasiswa";
			if($nim != null) {
				$sql .= " WHERE nim = $nim";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data dosen
		public function tambah($nim,$nama_mhs, $jk,$tgl_lahir,$no_telp,$alamat,$kode_jurusan) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO t_mahasiswa VALUES('$nim','$nama_mhs','$jk','$tgl_lahir','$no_telp','$alamat','$kode_jurusan')");
		}

		// fungsi edit data dosen
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql);
		}

		// fungsi hapus data dosen
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM t_mahasiswa WHERE nim = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>
