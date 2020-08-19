<?php
	// include models/model_jadwal.php
	include "models/model_matkul.php";

	$mtkl = new Matkul($connection);

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
							<h3 class="panel-title">Jadwal</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Matkul</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Kode Matkul</th>
													<th>Nama Matkul</th>
													<th>Sks</th>
													<th>Semester</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data jadwal -->
												<?php
													$no = 1;
													$tampil = $mtkl->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->kode_mk ; ?></td>
													<td><?php echo $data->nama_mk ; ?></td>
													<td><?php echo $data->sks ; ?></td>
													<td><?php echo $data->semester ; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_mtkl" data-toggle="modal" data-target="#edit" data-kode_mk="<?php echo $data->kode_mk; ?>" data-nama_mk="<?php echo $data->nama_mk; ?>" data-sks ="<?php echo $data->sks; ?>" data-semester="<?php echo $data->semester; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=matkul&act=del&id=<?php echo $data->kode_mk; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data jadwal -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data jadwal -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data jadwal -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Matkul</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Matkul</label>
													<input type="text" name="kode_mk" class="form-control" placeholder="Masukan Kode Matkul" id="kode_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mk">Nama Matkul</label>
													<input type="text" name="nama_mk" class="form-control" placeholder="Masukan Nama matkul" id="nama_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="sks">Sks</label>
													<input type="number" name="sks" class="form-control" placeholder="Masukan Jumlah Sks" id="sks" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="semester">Semester</label>
													<input type="number" name="semester" placeholder="Masukan semester" class="form-control" id="semester" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data matkul -->
										<?php
											if(@$_POST['tambah']) {
												$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
												$nama_mk  = $connection->conn->real_escape_string($_POST['nama_mk']);
												$sks = $connection->conn->real_escape_string($_POST['sks']);
												$semester  = $connection->conn->real_escape_string($_POST['semester']);
												if(@$_POST['tambah']) {
													$mtkl->tambah($kode_mk, $nama_mk,$sks, $semester);
													header("location: ?page=matkul"); // redirect ke form data jadwal
												} else {
													echo "<script>alert('Tambah data matkul gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data matkul -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data jadwal -->


							<!-- model pop up edit data jadwal -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data matkul</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Matkul</label>
													<!-- id setiap data kode_mk untuk parameter edit -->
													<input type="hidden" name="kode_mk" id="kode_mk">
													<input type="text" name="kode_mk " class="form-control" placeholder="Masukan kode Matkul" id="kode_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mk ">Nama Matkul</label>
													<input type="text" name="nama_mk" class="form-control" placeholder="Masukan nama matkul" id="nama_mk " required>
												</div>
												<div class="form-group">
													<label class="control-label" for="sks">Jumlah Sks</label>
													<input type="number" name="sks" class="form-control" placeholder="Masukan Jumlah Sks" id="sks" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="semester">Semester</label>
													<input type="number" name="semester" placeholder="Masukan semester" class="form-control" id="semester" required>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data jadwal -->

							<!-- get data jadwal dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_jdw
								$(document).on("click", "#edit_mtkl", function() {
									var kode_mk = $(this).data('kode_mk');
									var nama_mk= $(this).data('nama_mk');
									var sks = $(this).data('sks');
									var semester = $(this).data('semester');
									$("#modal-edit #kode_mk").val(kode_mk);
									$("#modal-edit #nama_mk").val(nama_mk);
									$("#modal-edit #sks").val(sks);
									$("#modal-edit #semester").val(semester);
								})

								// proses edit data jadwal dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_matkul.php',
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
		$mtkl->hapus($_GET['id']);
		// redirect
		header("location: ?page=matkul");
	}
