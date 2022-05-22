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
			<div class="card card-primary card-outline">
				<div class="card">
					<div class="card-header">
						<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
						<?php echo $this->session->flashdata('msg'); ?>
						<?php if (validation_errors()) { ?>
							<div class="alert alert-danger">
								<a class="close" data-dismiss="alert">x</a>
								<strong><?php echo strip_tags(validation_errors()); ?></strong>
							</div>
						<?php } ?>
						<buttton type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> &nbsp Cetak Data</buttton>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
								<thead>
									<th>#</th>
									<th>Pelapor</th>
									<th>Keluhan</th>
									<th>Jabatan</th>
									<th>Tgl Komplain</th>
									<th>Jam Komplain</th>
									<th>Tgl Tanggapan</th>
									<th>Jam Tanggapan</th>
									<!-- <th>Status</th> -->
									<th>Selesai</th>
									<th>Detail</th>

								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($list_komplain as $lk) : ?>
										<tr>
											<td><?php echo $i++; ?></td>

											<td><?php echo $user['nama']; ?></td>
											<td><?php echo $lk['area_keluhan']; ?></td>
											<td><?php echo $lk['jabatan']; ?></td>
											<td><?php echo $lk['date_komplain']; ?></td>
											<td><?php echo $lk['jam_komplain']; ?></td>
											<td><?php echo $lk['tgl_tanggapan']; ?></td>
											<td><?php echo $lk['jam_tanggapan']; ?></td>
											<!-- <?php if ($lk['status_komplain'] == 1) : ?>
                                                <td><span class="btn btn-block btn-danger btn-flat btn-sm">Pending</span></td>
                                            <?php elseif ($lk['status_komplain'] == 2) : ?>
                                                <td><span class="btn btn-block btn-warning btn-flat btn-sm">Proses</span></td>
                                            <?php else : ?>
                                                <td><button type="button" class="tombol-edit btn btn-success btn-block btn-sm" data-id="<?php echo $lk['id_komplain']; ?>" data-toggle="modal" data-target="#edit-komp">Approve</<button>
                                                </td>
                                            <?php endif; ?> -->
											<?php if ($lk['status_selesai'] == 0) : ?>
												<td style="text-align:center;"><i class="far fa-check-circle fa-2x"></i></td>
											<?php else : ?>
												<td style="text-align:center;"><i class="fas fa-hourglass-start fa-2x"></i></td>
											<?php endif; ?>
											<td><a href="<?php echo base_url('user/detail/') . $lk['id_komplain']; ?>" class="btn btn-info btn-block btn-sm">Detail</a> </td>
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
				<h4 class="modal-title">Konfirmasi Selesai</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<?php echo form_open_multipart('user/status_selesai'); ?>
					<div class="form-group">
						<label for="username">Keluhan</label>
						<input type="hidden" name="id_komplain" id="idjson">
						<input type="text" class="form-control form-control-sm" id="area" readonly>
					</div>
					<div class="form-group">
						<label for="nama">Client</label>
						<input type="text" class="form-control form-control-sm" id="client" list="cars" readonly />
						<datalist id="cars">
							<?php foreach ($client as $cl) : ?>
								<option><?php echo $cl['nama_client']; ?></option>
							<?php endforeach; ?>
						</datalist>
					</div>
					<div class="form-group">
						<label for="nama">Saran</label>
						<input type="text" class="form-control form-control-sm" id="saran" readonly>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama">Tanggal Komplain</label>
								<input type="date" class="form-control form-control-sm" id="tgl" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama">Jam Komplain</label>
								<input type="time" class="form-control form-control-sm" id="jam_komplain" readonly>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">Simpan Konfirmasi</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cetak PDF</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>Cetak Data Berdasarkan Tanggal</h5>
				<form action="<?php echo base_url('user/cetak_tanggal'); ?>" method="post" target="_blank">
					<div class="form-row">
						<div class="form-group col-md-10">
							<div class="form-group">
								<label for="nama">Tanggal</label>
								<input type="date" class="form-control form-control-sm" name="tanggal" value="<?php echo date("Y-m-d"); ?>" />
							</div>
						</div>
						<div class="form-group col-md-2 mt-4">
							<input type="submit" class="btn btn-primary btn-sm mt-2" value="Cetak" />
						</div>
					</div>
				</form>

				<h5>Cetak Data Berdasarkan Bulan, Tahun dan Klien</h5>
				<form action="<?php echo base_url('user/cetak_bulan'); ?>" method="post" target="_blank">
					<div class="form-row">
						<div class="form-group col-md-4">
							<span class="font-weight-bold">Bulan :</span>
							<select name="bulan" class="form-control form-control-sm">
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<span class="font-weight-bold">Tahun :</span>
							<select name="tahun" class="form-control form-control-sm">
								<?php
								$mulai = date('Y') - 10;
								for ($i = $mulai; $i < $mulai + 15; $i++) {
									$sel = $i == date('Y') ? ' selected="selected"' : '';
									echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<span class="font-weight-bold">Klien :</span>
							<input type="text" class="form-control form-control-sm" name="client" id="client" list="cars" required />
							<datalist id="cars">
								<?php foreach ($client as $cl) : ?>
									<option><?php echo $cl['nama_client']; ?></option>
								<?php endforeach; ?>
							</datalist>

						</div>
						<div class="form-group col-md-2 mt-4">
							<input type="submit" class="btn btn-primary btn-sm" value="Cetak" />
						</div>
					</div>
				</form>

				<!-- <h5>Cetak Data Berdasarkan Client</h5>
                <form action="<?php echo base_url('user/cetak_client'); ?>" method="post" target="_blank">
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <div class="form-group">
                                <label for="nama">Client</label>
                                <input type="text" class="form-control form-control-sm" name="client" id="client" list="cars" />
                                <datalist id="cars">
                                    <?php foreach ($client as $cl) : ?>
                                        <option><?php echo $cl['nama_client']; ?></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group col-md-2 mt-4">
                            <input type="submit" class="btn btn-primary btn-sm mt-2" value="Cetak" />
                        </div>
                    </div>
                </form> -->
			</div>
		</div>
	</div>
</div>



<script>
	$('.tombol-edit').on('click', function() {
		const id_komplain = $(this).data('id');
		$.ajax({
			url: '<?php echo base_url('user/get_edit_komplain'); ?>',
			data: {
				id_komplain: id_komplain
			},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#area').val(data.area_keluhan);
				$('#client').val(data.client);
				$('#jam_komplain').val(data.jam_komplain);
				$('#saran').val(data.saran);
				$('#tgl').val(data.date_komplain);
				$('#idjson').val(data.id_komplain);
			}
		});
	});
</script>
