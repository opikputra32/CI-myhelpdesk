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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-user">
                            Tambah Client
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Client</th>
                                    <th>Alamat</th>
                                    <th>Contact Person</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list_client as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['nama_client']; ?></td>
                                            <td><?php echo $lu['alamat']; ?></td>
                                            <td><?php echo $lu['kontak_person']; ?></td>
                                            <td><?php echo $lu['no_hp']; ?></td>
                                            <td><?php echo $lu['email_client']; ?></td>
                                            <td><button type="button" class="tombol-edit btn btn-primary btn-block btn-sm" data-id="<?php echo $lu['id_client']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button>
                                            </td>
                                            <td><a href="<?php echo base_url('admin/del_client/') . $lu['id_client']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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


<!-- Modal -->
<div class="modal fade" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Client</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/list_client'); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="nama">Nama Client</label>
                            <input type="text" class="form-control form-control-sm" name="nama_client" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat Client</label>
                            <input type="text" class="form-control form-control-sm" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Contact Person</label>
                            <input type="text" class="form-control form-control-sm" name="kontak_person" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">No HP</label>
                            <input type="number" class="form-control form-control-sm" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email_client" required>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Client</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_client'); ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Client</label>
                            <input type="hidden" name="id_client" id="id_client">
                            <input type="text" class="form-control form-control-sm" name="nama_client" id="nama_client" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat Client</label>
                            <input type="text" class="form-control form-control-sm" name="alamat" id="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Contact Person</label>
                            <input type="text" class="form-control form-control-sm" name="kontak_person" id="kontak_person" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">No HP</label>
                            <input type="number" class="form-control form-control-sm" name="no_hp" id="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email_client" id="email_client" required>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
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
        const id_client = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_client'); ?>',
            data: {
                id_client: id_client
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_client').val(data.nama_client);
                $('#alamat').val(data.alamat);
                $('#kontak_person').val(data.kontak_person);
                $('#no_hp').val(data.no_hp);
                $('#email_client').val(data.email_client);
                $('#id_client').val(data.id_client);
            }
        });
    });
</script>