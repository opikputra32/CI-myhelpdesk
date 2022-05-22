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
						<input type="button" class="btn btn-default btn-sm" value="Kembali" onclick="window.history.back()" />
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-primary card-outline">
				<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
				<?php if (validation_errors()) { ?>
					<div class="alert alert-danger">
						<a class="close" data-dismiss="alert">x</a>
						<strong><?php echo strip_tags(validation_errors()); ?></strong>
					</div>
				<?php } ?>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="callout callout-info">
									<h5><i class="far fa-file-alt"></i> Detail laporan Komplain</h5>
								</div>
								<!-- Main content -->
								<div class="invoice p-3 mb-3">
									<!-- title row -->
									<div class="row">
										<div class="col-12">
											<h4>
												<i class="fas fa-chess-queen"></i> Helpdesk IT
												<small class="float-right">Tanggal: <?php echo format_indo(date('Y-m-d')); ?></small>
											</h4>
										</div>
										<!-- /.col -->
									</div>
									<!-- info row -->
									<div class="row invoice-info">
										<div class="col-sm-4 invoice-col">
											Pembuat Laporan :

											<strong><?php echo $detail['nama']; ?></strong><br>
											Email : <?php echo $detail['email']; ?><br>
											No. Telp : <?php echo $detail['no_telp']; ?><br>
											Register : <?php echo format_indo($detail['date_created']); ?><br>
											Status : Aktif<br>

										</div>
										<!-- /.col -->
										<!-- <div class="col-sm-4 invoice-col">
                                            Klien Pelapor
                                            <address>
                                                <strong><?php echo $detail['nama_client']; ?></strong><br>
                                                Alamat :<?php echo $detail['alamat']; ?><br>
                                                CP : <?php echo $detail['kontak_person']; ?><br>
                                                Phone: <?php echo $detail['no_hp']; ?><br>
                                                Email: <?php echo $detail['email_client']; ?>
                                            </address>
                                        </div> -->
										<!-- /.col -->
										<div class="col-sm-4 invoice-col">
											<!-- <b>Invoice #007612</b><br>
                                            <br>
                                            <b>Order ID:</b> 4F3S8J<br>
                                            <b>Payment Due:</b> 2/22/2014<br>
                                            <b>Account:</b> 968-34567 -->
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->

									<!-- Table row -->
									<div class="row">
										<div class="col-12 table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Keluhan</th>
														<th>Tgl.Komplain</th>
														<th>Jam Komplain</th>
														<th>Tgl. Tanggapan</th>
														<th>Jam. Tanggapan</th>
														<th>Foto Komplain</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $detail['area_keluhan']; ?></td>
														<td><?php echo $detail['date_komplain']; ?></td>
														<td><?php echo $detail['jam_komplain']; ?></td>
														<td><?php echo $detail['tgl_tanggapan']; ?></td>
														<td><?php echo $detail['jam_tanggapan']; ?></td>
														<td><?php if ($detail['image_komplain'] == NULL) : ?>
																<img src="<?php echo base_url('assets/images/nopicture.png'); ?>" alt="..." class="img-thumbnail" style="width:300px;height:250px;">
															<?php else : ?>
																<img src="<?php echo base_url('assets/images/' . $detail['image_komplain']); ?>" alt="..." class="img-thumbnail" style="width:300px;height:250px;">
															<?php endif; ?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->

									<div class="row">
										<!-- accepted payments column -->
										<div class="col-6">
											<!-- <p class="lead font-weight-bolder">Saran : </p>
											<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;padding-left:10px;">
												<td><?php echo $detail['saran']; ?></td>
											</p> -->
											<p class="lead font-weight-bolder">Tanggapan : </p>
											<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;padding-left:10px;">
												<?php echo $detail['tanggapan']; ?>
											</p>
										</div>
										<!-- /.col -->

										<!-- /.col -->
									</div>
									<div class="row">
										<!-- accepted payments column -->
										<div class="col-6">

											<!-- <p class="lead font-weight-bolder">Saran : </p>
											<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;padding-left:10px;">
												<td><?php echo $detail['saran']; ?></td>
											</p> -->
											<p class="lead font-weight-bolder">Foto Tanggapan : </p>
											<?php if ($detail['image_tanggapan'] == NULL) : ?>
												<img src="<?php echo base_url('assets/images/nopicture.png'); ?>" alt="..." class="img-thumbnail" style="width:300px;height:250px;">
											<?php else : ?>
												<img src="<?php echo base_url('assets/images/' . $detail['image_tanggapan']); ?>" alt="..." class="img-thumbnail" style="width:300px;height:250px;">
											<?php endif; ?>
										</div>
										<!-- /.col -->




										<!-- /.col -->
									</div>
									<!-- /.row -->
									<!-- this row will not appear when printing -->
									<div class="row no-print">
										<!-- <div class="col-12">
                                            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                                Payment
                                            </button>
                                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                <i class="fas fa-download"></i> Generate PDF
                                            </button>
                                        </div> -->
									</div>
								</div>
								<!-- /.invoice -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
