<div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light"></span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#new">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="example" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($admin as $um) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle"><img
                                        src="<?= base_url('assets/img/profile/') . $um['image']; ?>"
                                        class="card-img m-2" alt="..." style="max-width: 30px"></td>
                                <td class="py-1 align-middle text-left"><?= $um['name']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $um['username']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $um['email']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $um['role']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $um['jns_kelamin']; ?></td>
                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('akun/editAdmin/') . $um['id']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('akun/deleteadmin/') . $um['id']; ?>"
                                        class="tombol-delete-user"><span class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>
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

<!-- Modal -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin Atau Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('akun/addadmin'); ?>" method="post">
                    <div class="form-group">
                        <label for="peran">Posisi</label>
                        <select class="form-control" name="role_id" id="peran">
                            <?php foreach ($role as $r) : ?>
                            <?php if ($r['id'] != "6") : ?>
                            <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Full Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Jenis Kelamin</label>
                        <input type="text" name="jns_kelamin" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">No.Telp</label>
                        <input type="number" name="no_hp" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
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
</div>