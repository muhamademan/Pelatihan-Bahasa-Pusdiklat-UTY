<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header shadow bg-primary border-bottom-warning">
                <span class="text-light">Edit Pelatihan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pelatihan/proseseditpelatihan') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $pelatihan['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama Pelatihan</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas"
                            value="<?= $pelatihan['nama_pelatihan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Keterangan</label>
                        <input name="alias" type="text" class="form-control" id="NamaKelas"
                            value="<?= $pelatihan['alias']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('pelatihan/latih') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>