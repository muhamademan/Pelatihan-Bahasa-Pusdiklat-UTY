<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $timeNow = time();
    ?>
    <div class="alert alert-light text-primary shadow mb-1" role="alert">
        Tanggal : <?= date('d M Y', $timeNow); ?>
    </div>
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning py-2">
            <div class="row">
                <div class="col">
                    <span class="text-light">Kelas</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-center">
                            <th width="1">No</th>
                            <th>Pertemuan Pelatihan</th>
                            <th>Waktu</th>
                            <th>Peserta</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kelas as $k) : ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= date('H:i', $k['tanggal']); ?> WIB</td>
                            <td><?= $k['peserta']; ?></td>
                            <td>
                                <a href="<?= base_url('jadwal_presensi/detailkelas/') . $k['id']; ?>"><i
                                        class="fa fa-list text-light mx-0 rounded-circle p-2 bg-primary icon-kelas"></i></a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>