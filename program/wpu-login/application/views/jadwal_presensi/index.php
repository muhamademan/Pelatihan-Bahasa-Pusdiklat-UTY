<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Pelatihan bahasa dilakukan sebanyak 10 kali pertemuan.
</div>
<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $timeNow = time();
    ?>
    <?= $this->session->flashdata('message'); ?>
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
                <?php if (empty($kelas)) : ?>
                <div class="h3 text-center py-5"> Belum ada rekap pretemuan</div>
                <?php else : ?>
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-center">
                            <th width="1">No</th>
                            <th>Nama Kelas</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Jumlah Peserta</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                            foreach ($kelas as $k) : ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['tanggal']; ?></td>
                            <td><?= $k['peserta']; ?></td>
                            <td>
                                <a href="<?= base_url('jadwal_presensi/detailkelas/') . $k['id']; ?>"><i
                                        class="fa fa-list text-light mx-0 rounded-circle p-2 bg-primary icon-kelas"></i></a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>