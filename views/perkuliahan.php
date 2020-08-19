<?php
	// include models/model_transaksi.php
	include "models/model_perkuliahan.php";

	$prklhn = new Perkuliahan($connection);
?>
<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Transaksi</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Perkuliahan</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>nim</th>
													<th>kode mata kuliah</th>
													<th>Nomor induk pegawai</th>
													<th>Nilai</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data transaksi -->
												<?php
													$no = 1;
													$tampil = $prklhn->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->nim; ?></td>
													<td><?php echo $data->kode_mk; ?></td>
													<td><?php echo $data->nip; ?></td>
													<td><?php echo $data->nilai; ?></td>
													 <td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_prklhn" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_perkuliahan; ?>" data-nilai="<?php echo $data->nilai ?>">
														<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button cetak per id -->
														<!-- button cetak per id -->
														<!-- <button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button> -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data transaksi -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data transaksi -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data transaksi -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Perkuliahan</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="nim">nim</label>
													<select class="form-control" name="nim"  id="nim" required>
														<?php
														// relasi dari t_mahasiswa
														// koneksi database
														$koneksi = mysqli_connect('localhost','root','','10118078__akademik');
														$sql = "SELECT * FROM t_mahasiswa";
														$hasil =mysqli_query($koneksi,$sql);
														echo '<option>-- pilih --</option>';
														while ($data = mysqli_fetch_array($hasil)){
														echo "<option value=" . $data['nim'] . ">" . $data['nim'] . "</option>";

														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Matkul</label>
													<select class="form-control" name="kode_mk"  id="kode_mk" required>
														<?php
														// relasi dari t_mahasiswa
														// koneksi database
														$koneksi = mysqli_connect('localhost','root','','10118078__akademik');
														$sql = "SELECT * FROM t_matkul";
														$hasil =mysqli_query($koneksi,$sql);
														echo '<option>-- pilih --</option>';
														while ($data = mysqli_fetch_array($hasil)){
														echo "<option value=" . $data['kode_mk'] . ">" . $data['nama_mk'] . "</option>";

														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="nip">Dosen</label>
													<select class="form-control" name="nip"  id="nip" required>
														<?php
														// relasi dari t_dosen
														// koneksi database
														$koneksi = mysqli_connect('localhost','root','','10118078__akademik');
														$sql = "SELECT * FROM t_dosen";
														$hasil =mysqli_query($koneksi,$sql);
														echo '<option>-- pilih --</option>';
														while ($data = mysqli_fetch_array($hasil)){
														echo "<option value=" . $data['nip'] . ">" . $data['nama_dosen'] . "</option>";

														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="nilai">Nilai</label>
													<input class="form-control" name="nilai"  id="nip" type="text" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data transaksi -->
										<?php
											if(@$_POST['tambah']) {
												$nim = $connection->conn->real_escape_string($_POST['nim']);
												$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
												$nip = $connection->conn->real_escape_string($_POST['nip']);
												$nilai = $connection->conn->real_escape_string($_POST['nilai']);
												if(@$_POST['tambah']) {
													$prklhn->tambah($nim, $kode_mk,$nip,$nilai);
													header("location: ?page=Perkuliahan"); // redirect ke form data transaksi
												} else {
													echo "<script>alert('Tambah data Perkuliahan gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data transaksi -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data transaksi -->


							<!-- model pop up edit data transaksi -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Transaksi</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="nilai">Nilai</label>
													<!-- id setiap data transaksi untuk parameter edit -->
													<input type="hidden" name="id_perkuliahan" id="id_perkuliahan">
													<input type="text" name="nilai" id="nilai">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data transaksi -->

							<!-- get data transaksi dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_trs
								$(document).on("click", "#edit_prklhn", function() {
									var id_prklhn = $(this).data('id');
									var nilai = $(this).data('nilai');
									$("#modal-edit #id_perkuliahan").val(id_prklhn);
									$("#modal-edit #nilai").val(nilai);
								})

								// proses edit data transaksi dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_perkuliahan.php',
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
