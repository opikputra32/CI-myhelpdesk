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
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert">x</a>
                        <strong><?php echo strip_tags(validation_errors()); ?></strong>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <buttton type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> &nbspCetak Data</buttton>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Operator</th>
                                    <th>Level</th>
                                    <th>Keluhan</th>
                                    <th>Klien</th>
                                    <th>Tgl Komplain</th>
                                    <th>Jam Komplain</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list_komplain as $lk) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lk['nama']; ?></td>
                                            <td><?php echo $lk['level']; ?></td>
                                            <td><?php echo $lk['area_keluhan']; ?></td>
                                            <td><?php echo $lk['client']; ?></td>
                                            <td><?php echo $lk['date_komplain']; ?></td>
                                            <td><?php echo $lk['jam_komplain']; ?></td>
                                            <?php if ($lk['status_komplain'] == 1) : ?>
                                                <td><span class="btn btn-block btn-danger btn-flat btn-sm">Waiting..</span></td>
                                            <?php elseif ($lk['status_komplain'] == 2) : ?>
                                                <td><span class="btn btn-block btn-warning btn-flat btn-sm">Process..</span></td>
                                            <?php else : ?>
                                                <td style="text-align:center;"><i class="far fa-check-circle fa-2x"></i></td>
                                            <?php endif; ?>
                                            <td><a href="<?php echo base_url('admin/detail_komplain/') . $lk['id_komplain']; ?>" class="btn btn-primary btn-block btn-sm">Detail</a> </td>
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
                <form action="<?php echo base_url('admin/cetak_tanggal'); ?>" method="post" target="_blank">
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
                <form action="<?php echo base_url('admin/cetak_bulan'); ?>" method="post" target="_blank">
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
                <form action="<?php echo base_url('admin/cetak_client'); ?>" method="post" target="_blank">
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