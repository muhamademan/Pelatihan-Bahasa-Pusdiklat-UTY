<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header shadow bg-primary border-bottom-warning">
                <span class="text-light">Edit Role</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('akun/proseseditRole') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $role['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Jenis Role</label>
                        <input name="role" type="text" class="form-control" id="NamaKelas"
                            value="<?= $role['role']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('akun/role') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>