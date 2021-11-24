<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Peserta Pelatihan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/proseseditpeserta') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $data_peserta['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">No Identitas</label>
                        <input name="no_identitas" type="number" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['no_identitas']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama Peserta</label>
                        <input name="nama_peserta" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['nama_peserta']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Tanggal Lahir</label>
                        <input name="tgl_lahir" type="date" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['tgl_lahir']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Jenis Kelamin</label>
                        <input name="jenis_kelamin" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['jenis_kelamin']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Prodi</label>
                        <input name="prodi" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['prodi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama Instansi</label>
                        <input name="nama_instansi" type="text" class="form-control" id="NamaKelas"
                            value="<?= $data_peserta['nama_instansi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Formenu">Kelas Pelatihan</label>
                        <select class="form-control" id="Formenu" name="kelas_id">
                            <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id'] ?>" <?php if ($data_peserta['kelas_id'] == $k['id']) : ?>
                                <?php endif; ?>>
                                <?= $k['nama'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('admin/peserta') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>