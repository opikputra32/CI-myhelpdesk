<style>
	.dataTables_wrapper {
		font-size: 16px
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?php echo $title; ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
						<?php echo $this->session->flashdata('msg'); ?>
						<?php if (validation_errors()) { ?>
							<div class="alert alert-danger">
								<a class="close" data-dismiss="alert">x</a>
								<strong><?php echo strip_tags(validation_errors()); ?></strong>
							</div>
						<?php } ?>
						<!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-saran">
							Tambah Keluhan
						</button> -->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
								<thead>
									<th>#</th>
									<th>Nama User</th>
									<th>Level</th>
									<th>Keluhan</th>
									<th>Tgl Komplain</th>
									<th>Jam Komplain</th>
									<th>Status</th>
									<th>Konfirmasi</th>
									<th>Detail</th>
									<th>Hapus</th>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($list_komplain as $lk) : ?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $lk['nama']; ?></td>
											<td><?php echo $lk['level']; ?></td>
											<td><?php echo $lk['area_keluhan']; ?></td>
											<td><?php echo $lk['date_komplain']; ?></td>
											<td><?php echo $lk['jam_komplain']; ?></td>
											<?php if ($lk['status_komplain'] == 1) : ?>
												<td style="text-align:center;">
													<span class="btn btn-block btn-secondary btn-flat btn-sm">Waiting..</span>
												</td>
											<?php elseif ($lk['status_komplain'] == 2) : ?>
												<td><span class="btn btn-block btn-warning btn-flat btn-sm">Process..</span></td>
											<?php else : ?>
												<td><span class="btn btn-block btn-info btn-flat btn-sm">Success</span></td>
											<?php endif; ?>
											<td> <button type="button" class="tombol-edit btn btn-primary btn-block btn-sm" data-id="<?php echo $lk['id_komplain']; ?>" data-toggle="modal" data-target="#edit-komp">Confirm</button></td>
											<td><a href="<?php echo base_url('admin/detail_komplain/') . $lk['id_komplain']; ?>" class="btn btn-info btn-block btn-sm">Detail</a> </td>
											<td><a href="<?php echo base_url('admin/del_komplain/') . $lk['id_komplain']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="edit-komp">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<?php echo form_open_multipart('admin/edit_komplain'); ?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="username">Keluhan</label>
								<input type="hidden" name="id_komplain" id="idjson">
								<input type="text" class="form-control form-control-sm" name="area_keluhan" id="area" disabled>
							</div>
							<!-- <div class="form-group">
								<label for="nama">Klien</label>
								<input type="text" class="form-control form-control-sm" name="client" list="cars" id="client" />
								<datalist id="cars">
									<?php foreach ($client as $cl) : ?>
										<option><?php echo $cl['nama_client']; ?></option>
									<?php endforeach; ?>
								</datalist>
							</div> -->
							<!-- <div class="form-group">
								<label for="nama">Saran</label>
								<input type="text" class="form-control form-control-sm" name="saran" id="saran" required>
							</div> -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Tanggal Komplain</label>
										<input type="date" class="form-control form-control-sm" name="date_komplain" id="tgl" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Jam Komplain</label>
										<input type="time" class="form-control form-control-sm" name="jam_komplain" id="jam_komplain" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Tanggal Tanggapan</label>
										<input type="date" class="form-control form-control-sm" name="tgl_tanggapan">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Jam Tanggapan</label>
										<input type="time" class="form-control form-control-sm" name="jam_tanggapan">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Tanggapan</label>
										<textarea class="form-control" rows="3" name="tanggapan"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleFormControlFile1">Upload Gambar</label>
										<input type="file" class="form-control-file" name="image">
									</div>
									<span class="text-muted" style="font-size:12px;">Format gambar JPG, JPEG, PNG, GIF dan ukuran gambar kurang dari 2 mb</span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<!-- <div class="form-group">
                                <label for="nama">Foto Upload</label>
                                <img src="" class="img-thumbnail" alt="User Image" style="width:400px;" id="image"><br>
                            </div> -->
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_komplain" id="status_komplain" value="1" checked>
							<label class="form-check-label" for="exampleRadios3">
								Belum Ditanggapi
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_komplain" id="status_komplain" value="2">
							<label class="form-check-label" for="exampleRadios1">
								Proses
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_komplain" id="status_komplain" value="0">
							<label class="form-check-label" for="exampleRadios2">
								Sudah Ditanggapi
							</label>
						</div>

					</div>
					<button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>

<div class="modal fade" id="add-saran">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Komplain, Kritik, dan Saran</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<?php echo form_open_multipart('admin/add_komplain'); ?>
					<div class="form-group">
						<label for="username">Keluhan</label>
						<input type="text" class="form-control form-control-sm" name="area_keluhan" required>
					</div>
					<div class="form-group">
						<label for="nama">Klien</label>
						<input type="text" class="form-control form-control-sm" name="client" list="cars" />
						<datalist id="cars">
							<?php foreach ($client as $cl) : ?>
								<option><?php echo $cl['nama_client']; ?></option>
							<?php endforeach; ?>
						</datalist>
					</div>
					<div class="form-group">
						<label for="nama">Saran</label>
						<input type="text" class="form-control form-control-sm" name="saran" required>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nama">Tanggal Komplain</label>
								<input type="date" class="form-control form-control-sm" name="date_komplain" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nama">Jam Komplain</label>
								<input type="time" class="form-control form-control-sm" name="jam_komplain" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlFile1">Upload Gambar</label>
								<input type="file" class="form-control-file" name="image">
							</div>
						</div>
						<span class="text-muted" style="font-size:12px;">* Format gambar JPG, JPEG, PNG, GIF dan ukuran gambar kurang dari 2 mb</span>
						<hr>
					</div>
					<button type="submit" class="btn btn-primary pull-right">Kirim Data</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>


<script>
	$('.tombol-edit').on('click', function() {
		const id_komplain = $(this).data('id');
		$.ajax({
			url: '<?php echo base_url('admin/get_edit_komplain'); ?>',
			data: {
				id_komplain: id_komplain
			},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#area').val(data.area_keluhan);
				$('#client').val(data.client);
				$('#saran').val(data.saran);
				$('#tgl').val(data.date_komplain);
				$('#jam_komplain').val(data.jam_komplain);
				$("#image").attr('src', '<?php echo base_url() ?>assets/images/' + data.image);
				$('#idjson').val(data.id_komplain);
			}
		});
	});
</script>
