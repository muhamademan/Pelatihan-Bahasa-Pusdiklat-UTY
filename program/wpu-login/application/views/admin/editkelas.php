<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <span class="text-primary">Edit kelas</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/proseseditkelas') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $kelas['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama kelas</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas"
                            value="<?= $kelas['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <?php $datetime = date('Y-m-d\TH:i', $kelas['tanggal']); ?>
                        <label for="Waktu">Waktu</label>
                        <input name="waktu" type="datetime-local" class="form-control" id="Waktu"
                            value="<?= $datetime; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Kuota</label>
                        <input name="kuota" type="number" class="form-control" id="NamaKelas"
                            value="<?= $kelas['kuota']; ?>">
                    </div>

                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Buka"
                            value="1"
                            <?php if ($kelas['status']  == 1) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Buka">Buka</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Tutup"
                            value="0"
                            <?php if ($kelas['status']  == 0) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Tutup">Tutup</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('admin/jadwalkelas') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>