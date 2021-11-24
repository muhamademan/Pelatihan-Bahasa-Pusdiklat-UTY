<?= $this->session->flashdata('message'); ?>

<!-- Batasan -->
<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $timeNow = time();
    ?>
    <div class="row">
        <div class="col-md-10 py-0 mb-1">
            <div class="card shadowx">
                <div class="card-body p-0">
                    <div class="table-responsive">




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-header bg-primary border-bottom-warning text-light py-2">
            Peserta
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" action="<?= base_url('jadwal_presensi/simpanpeserta'); ?>" name="form1" id="form1"
                    onSubmit="return valregister()">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>No identitas</th>
                                <th>Nama Peserta</th>
                                <th>Institusi</th>
                                <th>Fakultas</th>
                                <th>Pelatihan</th>
                                <th>Spesifikasi</th>
                                <th>Presensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="col-lg-5">
                                <input type="hidden" class="form-control" id="id_user" name="id_user">
                            </div>
                            <div class="col-lg-5">
                                <input type="hidden" class="form-control" id="id_user" name="id_kelas">
                            </div>
                            <div class="col-lg-5">
                                <input type="hidden" class="form-control" id="id_kelas" name="id_kelas"
                                    value="<?php foreach ($data_peserta as $kls) : ?> <?php echo $kls['id']; ?>"
                                    <?php endforeach; ?>>
                            </div>
                            <?php $no = 1;
                            foreach ($data_peserta as $p) : ?>
                            <tr class="text-center">
                                <td><?= $no++; ?></td>
                                <td><?= $p['no_identitas']; ?></td>
                                <td>
                                    <div class="text-dark font-weight-bold"><?= $p['nama_peserta']; ?>
                                    </div>
                                </td>
                                <td><?= $p['nama_instansi']; ?></td>
                                <td><?= $p['fakultas']; ?></td>
                                <td><?= $p['sertifikasi']; ?></td>
                                <td><?= $p['spesifikasi']; ?></td>
                                <!-- Absensi -->
                                <td>
                                    <?php if ($p['presensi'] == 0) : ?>
                                    <a href="<?= base_url('jadwal_presensi/hadir/') . $p['id'] . '/' . $kelas_id; ?>"
                                        class="btn btn-outline-primary" type="submit">Hadir</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('jadwal_presensi/belumhadir/') . $p['id'] . '/' . $kelas_id; ?>"
                                        class="btn btn-outline-danger" type="submit">Tidak
                                        Hadir</a>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <td style="border-top:none;">
                        <!-- <?php foreach ($data_peserta as $kls) :  $kelas_id = $kls['kelas_id'];

                                endforeach; ?> -->
                        <a href="<?= base_url('jadwal_presensi/tambahberita/') . $kelas_id ?>"
                            class="btn btn-lg btn-block btn-success py-2 mt-1" type="submit">Simpan Presensi &
                            Materi Pelatihan</a>
                    </td>
            </div>
        </div>
        <div class="card-footer text-right py-1">
            <a href="<?= base_url('jadwal_presensi') ?>" class="btn btn-light text-primary">&#8592; Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>