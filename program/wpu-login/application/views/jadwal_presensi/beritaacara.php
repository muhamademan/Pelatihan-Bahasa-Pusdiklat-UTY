<!-- ========== BERITA ACARA ============= -->
<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $timeNow = time();
    ?>
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning">
            <div class="row">
                <div class="col">
                    <span class="text-light">Rekap Pertemuan</span>
                </div>
                <div class="text-right">
                    <a href="<?= base_url('jadwal_presensi/index') ?>" class="btn-primary text-light">&#8592;
                        Kembali</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="<?= base_url('jadwal_presensi/tambahberitaacara'); ?>" name="form1"
                    id="form1" onSubmit="return valregister()">


                    <div class="table-responsive">
                        <table class="table">
                            <tr>

                                <div class="col-lg-5">
                                    <input type="hidden" class="form-control" id="id_user" name="id_user">
                                </div>
                                <div class="col-lg-5">
                                    <input type="hidden" class="form-control" id="id_kelas" name="id_kelas"
                                        value="<?php foreach ($kelas as $kls) : ?> <?php echo $kls['id']; ?>"
                                        <?php endforeach; ?>>
                                </div>

                                <div class="col-lg-5 mt-2">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas"
                                        value="<?php foreach ($kelas as $kls) : ?> <?php echo $kls['nama']; ?>"
                                        <?php endforeach; ?> readonly>
                                </div>
                                <div class="col-lg-5 mt-2">
                                    <label for="nama_pelatihan">Jenis Pelatihan</label>
                                    <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan"
                                        value="<?php foreach ($kelas as $kls) : ?><?php echo $kls['nama_pelatihan']; ?>"
                                        <?php endforeach; ?> readonly>
                                </div>

                                <div class="col-lg-5 mt-2">
                                    <label for="kelas">Pertemuan</label>
                                    <input type="text" class="form-control" id="pertemuan" name="pertemuan"
                                        value="Pertemuan Ke <?php foreach ($pertemuan as $p) : ?> <?= $p['jml'] + 1; ?>"
                                        <?php endforeach; ?> readonly>

                                </div>

                                <div class="col-lg-5 mt-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal"
                                        value="<?= date('d M Y', $timeNow); ?>" readonly>
                                </div>

                                <div class="col-lg-5 mt-2">
                                    <label for="mento">Nama Mentor</label>
                                    <input type="text" class="form-control" id="nama_mentor" name="nama_mentor"
                                        value="<?php echo $user['name']; ?>" readonly>
                                </div>
                                <td style="border-top:none;">
                                    <textarea class="form-control" rows="5" name="berita" id="berita"
                                        placeholder="Materi Pelatihan Bahasa. . ." required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top:none;">
                                    <button type="submit" name="simpan"
                                        class="btn btn-lg btn-block btn-primary py-2 mt-1">Selesai
                                        Pelatihan</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>