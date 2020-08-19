<?php


	// include models/model_dosen.php
	include "models/model_mahasiswa.php";

	$mhs = new Mahasiswa($connection);

	// untuk clean dan mengamankan parameter pada link browser
	if(@$_GET['act'] == '') {
?>
<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Armada</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Mahasiswa </h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nim.</th>
													<th>Nama Mahasiswa</th>
													<th>Jenis Kelamin</th>
													<th>Tanggal Lahir</th>
													<th>No. Telp</th>
													<th>Alamat</th>
                          <th>kode jurusan</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data dosen -->
												<?php
													$no = 1;
													$tampil = $mhs->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->nim; ?></td>
													<td><?php echo $data->nama_mhs; ?></td>
													<td><?php echo $data->jk; ?></td>
													<td><?php echo $data->tgl_lahir; ?></td>
													<td><?php echo $data->no_telp; ?></td>
													<td><?php echo $data->alamat; ?></td>
                          <td><?php echo $data->kode_jurusan; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_mhs" data-toggle="modal" data-target="#edit" data-nim="<?php echo $data->nim; ?>" data-nama_mhs="<?php echo $data->nama_mhs; ?>" data-jk="<?php echo $data->jk; ?>" data-tgl_lahir="<?php echo $data->tgl_lahir; ?>" data-no_telp="<?php echo $data->no_telp; ?>" data-alamat="<?php echo $data->alamat; ?>" data-kode_jurusan="<?php echo $data->kode_jurusan; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=mahasiswa&act=del&id=<?php echo $data->nim; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data dosen -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data armada -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data armada -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Mahasiswa</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="nim">Nomor Induk Mahasiswa</label>
													<input type="text" name="nim" class="form-control" placeholder="Masukan nomor Nomor Induk Mahasiswa" id="nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mhs">Nama Mahasiswa</label>
													<input type="text" name="nama_mhs" class="form-control" placeholder="Masukan nama dosen" id="nama_mhs" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="jk">Jenis Kelamin</label>
													<input type="text" name="jk" class="form-control" placeholder="Masukan jenis Kelamin" id="jk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
													<?php
													  $tgl_lahir=date('Y-m-d H:i:s');
													?>
													<input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="no_telp">Nomor Telpon</label>
													<input type="text" name="no_telp" class="form-control" placeholder="Masukan No. Telpon" id="no_telp" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">alamat</label>
													<textarea rows="4" name="alamat" class="form-control" placeholder="Masukan Alamat" id="alamat" required></textarea>
												</div>
                        <div class="form-group">
                        	<label class="control-label" for="kode_jurusan">Kode Jurusan</label>
                        	<select class="form-control" name="kode_jurusan"  id="kode_jurusan" required>
                        		<?php
                        		// relasi dari t_jurusan
                        		// koneksi database
                        		$koneksi = mysqli_connect('localhost','root','','10118078__akademik');
                        		$sql = "SELECT * FROM t_jurusan";
                        		$hasil =mysqli_query($koneksi,$sql);
                        		echo '<option>-- pilih --</option>';
                        		while ($data = mysqli_fetch_array($hasil)){
                        		echo "<option value=" . $data['kode_jurusan'] . ">" . $data['kode_jurusan'] . "</option>";

                        		}
                        		?>
                        	</select>
                        </div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data dosen -->
										<?php
											if(@$_POST['tambah']) {
												$nim = $connection->conn->real_escape_string($_POST['nim']);
												$nama_mhs = $connection->conn->real_escape_string($_POST['nama_mhs']);
												$jk = $connection->conn->real_escape_string($_POST['jk']);
												$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
												$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
												$alamat = $connection->conn->real_escape_string($_POST['alamat']);
                        $kode_jurusan = $connection->conn->real_escape_string($_POST['kode_jurusan']);
												if(@$_POST['tambah']) {
													$mhs->tambah($nim,$nama_mhs,$jk,$tgl_lahir,$no_telp,$alamat,$kode_jurusan);
													header("location: ?page=mahasiswa"); // redirect ke form data armada
												} else {
													echo "<script>alert('Tambah data Mahasiswa gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data dosen -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data armada -->


							<!-- model pop up edit data armada -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Mahasiswa</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="nama_mhs">Nama Mahasiswa</label>
													<!-- id setiap data armada untuk parameter edit -->
													<input type="hidden" name="nim" id="nim">
													<input type="text" name="nama_mhs" class="form-control" placeholder="Masukan Nama Mahasiswa" id="nama_mhs" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="jk">Jenis Kelamin</label>
													<input type="text" name="jk" class="form-control" placeholder="Masukan jenis armada" id="jk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                          <?php
													  $tgl_lahir=date('Y-m-d H:i:s');
													?>
													<input type="date" name="tgl_lahir" class="form-control" placeholder="Masukan Tanggal Lahir dengan format ex : 2020-04-15" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="no_telp">Nomor Telpon</label>
													<input type="text" name="no_telp" class="form-control" placeholder="Masukan No. Telpon" id="no_telp" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">Alamat</label>
													<input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" id="alamat" required>
												</div>
                        <div class="form-group">
                          <label class="control-label" for="kode_jurusan">Kode Jurusan</label>
                          <select class="form-control" name="kode_jurusan"  id="kode_jurusan" required>
                            <?php
                            // relasi dari t_jurusan
                            // koneksi database
                            $koneksi = mysqli_connect('localhost','root','','10118078__akademik');
                            $sql = "SELECT * FROM t_jurusan";
                            $hasil =mysqli_query($koneksi,$sql);
                            echo '<option>-- pilih --</option>';
                            while ($data = mysqli_fetch_array($hasil)){
                            echo "<option value=" . $data['kode_jurusan'] . ">" . $data['nama_jurusan'] . "</option>";

                            }
                            ?>
                          </select>
                        </div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data armada -->

							<!-- get data armada dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_amd
								$(document).on("click", "#edit_mhs", function() {
									var nim = $(this).data('nim');
									var nama_mhs = $(this).data('nama_mhs');
									var jk = $(this).data('jk');
									var tgl_lahir = $(this).data('tgl_lahir');
									var no_telp = $(this).data('no_telp');
									var alamat = $(this).data('alamat');
                  var alamat = $(this).data('alamat');
									$("#modal-edit #nim").val(nim);
									$("#modal-edit #nama_mhs").val(nama_mhs);
									$("#modal-edit #jk").val(jk);
									$("#modal-edit #tgl_lahir").val(tgl_lahir);
									$("#modal-edit #no_telp").val(no_telp);
									$("#modal-edit #alamat").val(alamat);
                  $("#modal-edit #kode_jurusan").val(kode_jurusan);
								})

								// proses edit data doseb dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_mahasiswa.php',
											type : 'POST',
											data : new FormData(this),
											contentType : false,
											cache : false,
											processData : false,
											success : function(msg) {
												$('.table').html(msg);
											}
										});
									}));
								})
							</script>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->
<?php
	} else if(@$_GET['act'] == 'del') {
		// echo "proses delete untuk id : ".$_GET['id'];
		$dsn->hapus($_GET['id']);
		// redirect
		header("location: ?page=mahasiswa");
	}
