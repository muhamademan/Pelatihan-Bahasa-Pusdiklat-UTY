<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning">
            <div class="row">
                <div class="col">
                    <span class="text-light">Rekap Pertemuan</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if (empty($kelas)) : ?>
                <div class="h3 text-center py-5"> Belum ada rekap pertemuan</div>
                <?php else : ?>
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tanggal Mulai</th>
                            <th>Total Pertemuan</th>
                            <th>Pertemuan Terselenggara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                            foreach ($kelas as $k) : ?>
                        <tr class="text-center">
                            <td class="pb-0 pt-2"><?= $no++; ?></td>
                            <td class="pb-0 pt-2"><?= $k['nama']; ?></td>
                            <td class="pb-0 pt-2"><?= $k['tanggal']; ?></td>
                            <td class="pb-0 pt-2">10</td>
                            <td class="pb-0 pt-2"><?= $k['pertemuan']; ?></td>

                            <td>
                                <a href="<?= base_url('user/detailRekapMentor/') . $k['id']; ?>"> <i
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