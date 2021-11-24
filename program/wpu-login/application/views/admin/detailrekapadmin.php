<style>
.center {
    text-align: center;
}

@media print {
    @page {
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .sticky-footer,
    .sidebar,
    .btn,
    .pertemuan {
        display: none;
    }

    .kotak {
        display: contents !important;
    }
}
</style>

<div class="kotak" hidden>
    <div class="center">
        <img class="float-left" height="140" src="<?= base_url('assets/img/uty.png'); ?>" alt="">
        <div style="margin-right: 80px; margin-bottom: 28px;">
            <h1>PELATIHAN BAHASA</h1>
            <h3>Universitas Teknologi Yogyakarta</h3>
            <p>Jl. Siliwangi (Ringroad Utara), Jombor, Sleman, D.I. Yogyakarta 55285</p>
        </div>

        <hr style="border-top: solid black;">
    </div>
</div>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning text-light py-2">
            Laporan Pelatihan Bahasa
        </div>

        <!-- awal hapus -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <?php $aa = $this->session->flashdata('pert'); ?>
                    <form action="<?= base_url('admin/detail_rekapadmin') ?>" method="post">
                        <thead>
                            <tr class="pertemuan">
                                <td>
                                    Pilih Pertemuan
                                </td>
                                <td>
                                    <select class="form-control" name="pertemuann" required>

                                        <option value="" hidden> -- Pilih Pertemuan --</option>
                                        <?php foreach ($pertemuan as $p) : ?>
                                        <option value="<?= $p['pertemuan']; ?>"><?= $p['pertemuan']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <input type="hidden" value="<?= $p['id_kelas']; ?>" name="id_kelas">
                                </td>
                                <td>
                                    <input type="submit" name="lihat" value="Lihat" class="btn btn-success">
                                    <input type="submit" onclick="window.print()" name="lihat" value="cetak"
                                        class="btn btn-primary">
                                </td>
                            </tr>
                        </thead>

                    </form>


                    <thead>
                        <?php
                        foreach ($peserta1 as $dp) : ?>
                        <tr>
                            <td>Pertemuan Ke</td>
                            <td><?= $dp['pertemuan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pertemuan</td>
                            <td><?= $dp['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Mentor</td>
                            <td><?= $dp['nama_mentor']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Pelatihan</td>
                            <td><?= $dp['jenis_pelatihan']; ?></td>
                        </tr>

                        <tr>
                            <td>Materi Pelatihan</td>
                            <td>
                                <textarea rows="4" cols="30" disabled><?= $dp['berita']; ?></textarea>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <tr style="background-color: grey; color: white;">
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Status Kehadiran</th>
                        </tr>
                        <?php $no = 1;
                        foreach ($peserta2 as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['nama_peserta']; ?></td>
                            <td><?= $p['keterangan']; ?></td>
                        </tr>
                        <?php endforeach ?>
                    </thead>
                </table>
            </div>
        </div>
        <!-- akhir hapus -->
        <div class="card-footer text-right">
            <a href="<?= base_url('admin/rekapadmin/'); ?>" class="btn btn-light text-primary">&#8592;
                Kembali</a>
        </div>
    </div>
</div>