<div class="container-fluid">
    <div class="row">
        <div class="col-8 mb-5">
            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-2 text-right">
                    <button class="btn btn-success py-0" data-toggle="modal" data-target="#newRole">Tambah role</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="80" class="text-center">Role ID</th>
                                    <th>Role</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($role as $r) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $r['role'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('akun/editRole/') . $r['id']; ?>"> <i
                                                class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i>
                                        </a>
                                        <a href="<?= base_url('akun/deleteRole/') . $r['id']; ?>"
                                            class="tombol-delete-role"><i
                                                class="fa fa-trash text-light mx-0 rounded-circle py-2 px-2 bg-danger icon-kelas"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('akun/addRole'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama Role</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>