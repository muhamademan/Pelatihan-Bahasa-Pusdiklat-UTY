<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Admin Pelatihan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('akun/proseseditAdmin/') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $data_user['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_user['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Username</label>
                        <input name="username" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_user['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Jenis Kelamin</label>
                        <input name="jns_kelamin" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_user['jns_kelamin']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">No.Telp</label>
                        <input name="no_hp" type="number" class="form-control" id="NamaKelas"
                            value="<?= $data_user['no_hp']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Email</label>
                        <input name="email" type="email" class="form-control" id="NamaKelas"
                            value="<?= $data_user['email']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('akun/admin') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>