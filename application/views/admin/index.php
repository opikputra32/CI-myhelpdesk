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
                        <button type="button" class="btn btn-default btn-sm mr-1" data-toggle="modal" data-target="#ubah-profile">Ubah Profile</button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ubah-pass">Ubah Password</button>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?php echo $count_user; ?></h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $count_komplain_belum; ?></h3>
                            <p>Belum Ditanggapi</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-times-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $count_komplain_proses; ?></h3>
                            <p>Dalam Proses</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $count_clear; ?></h3>
                            <p>Status Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-check-square"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
            </div>

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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Keluhan</th>
                                    <th>Klien</th>
                                    <th>Tgl Komplain</th>
                                    <th>Jam Komplain</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list_komplain as $lk) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lk['nama']; ?></td>
                                            <td><?php echo $lk['area_keluhan']; ?></td>
                                            <td><?php echo $lk['client']; ?></td>
                                            <td><?php echo $lk['date_komplain']; ?></td>
                                            <td><?php echo $lk['jam_komplain']; ?></td>
                                            <?php if ($lk['status_komplain'] == 1) : ?>
                                                <td><span class="btn btn-block btn-secondary btn-flat btn-sm">Waiting..</span></td>
                                            <?php elseif ($lk['status_komplain'] == 2) : ?>
                                                <td><span class="btn btn-block btn-warning btn-flat btn-sm">Process..</span></td>
                                            <?php else : ?>
                                                <td><span class="btn btn-block btn-info btn-flat btn-sm">Success</span></td>
                                            <?php endif; ?>
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


<div class="modal fade" id="ubah-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Profile</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/edit_profile'); ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bagian" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bagian" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"><label>Photo</label></div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control-file" name="image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted" style="font-size:12px;">* Format Photo JPG, JPEG, PNG, GIF dan ukuran gambar kurang dari 2 mb</span>
                    <hr style="margin-bottom:10px;margin-top:2px;">
                    <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- Modal -->
<div class="modal fade" id="ubah-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/ubah_password'); ?>" method="post">
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password1">Password Baru</label>
                            <input type="password" class="form-control" id="new_password1" name="new_password1">
                        </div>
                        <div class="form-group">
                            <label for="new_password2">Ulang Password Baru</label>
                            <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>