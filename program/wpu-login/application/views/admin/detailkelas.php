<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning text-light">
            Kelas : <?= $kelas['nama']; ?>
            <span class="badge badge-info"><?= date('H:i', $kelas['tanggal']); ?> WIB</span>
            <span class="badge badge-info"><?= date('d M Y', $kelas['tanggal']); ?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Identitas</th>
                            <th>Nama & kontak</th>
                            <th>Institusi</th>
                            <th>Pelatihan</th>
                            <th>Spesifikasi</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_peserta as $dp) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dp['no_identitas']; ?></td>
                            <td>
                                <div class="text-dark"><?= $dp['nama_peserta']; ?></div>
                                <div class="font-weight-light"><?= $dp['email']; ?></div>
                                <div class="font-weight-light"><?= $dp['hp']; ?></div>
                            </td>
                            <td><?= $dp['nama_instansi']; ?></td>
                            <td><?= $dp['pelatihan']; ?></td>
                            <td>-</td>
                            <td>
                                <?php if ($dp['presensi'] == 1) : ?>
                                <div class="text-success">Hadir</div>
                                <?php else : ?>
                                <div class="text-danger">Tidak hadir</div>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?= base_url('admin/jadwalkelas/'); ?>" class="btn btn-light text-primary">&#8592; Kembali</a>
        </div>
    </div>
</div>