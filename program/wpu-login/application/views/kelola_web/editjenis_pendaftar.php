<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Jenis Pendaftar</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('superadmin/prosesedit_pendaftar') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $jenis_pendaftar['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Jenis Pendaftar</label>
                        <input name="nama_jenis" type="text" class="form-control" id="NamaKelas"
                            value="<?= $jenis_pendaftar['nama_jenis']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('superadmin/jenis_pendaftar') ?>"
                            class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>