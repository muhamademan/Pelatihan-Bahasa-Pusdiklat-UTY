<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning text-light py-2">
            Rekap Admin Pelatihan
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
                            <th>Jenis Pelatihan</th>
                            <th>Nama Mentor</th>
                            <th>Berita Acara</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $dp) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dp['no_identitas']; ?></td>
                            <td>
                                <div class="text-dark"><?= $dp['nama_peserta']; ?></div>
                                <div class="font-weight-light"><?= $dp['email']; ?></div>
                                <div class="font-weight-light"><?= $dp['hp']; ?></div>
                            </td>
                            <td><?= $dp['nama_instansi']; ?></td>
                            <td><?= $dp['nama_pelatihan']; ?></td>
                            <td><?= $dp['name']; ?></td>
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
                <script type="text/javascript">
                window.print();
                </script>
            </div>
        </div>
    </div>
</div>