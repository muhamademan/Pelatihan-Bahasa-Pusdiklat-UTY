<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Kelas yang sudah dipilih peserta dapat diubah sesuai dengan permintaan dari peserta.
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-5">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-2">
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <span class="text-light">Data Peserta Pelatihan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Peserta -->
                    <!-- <div class="navbar-form navbar-right">
                        <form action="<?= base_url('admin/searchPst'); ?>" method="POST"> -->
                    <!-- <? echo form_open('admin/searchPst'); ?> -->
                    <!-- <input type="search" name="keyword" class="form-control col-2 mb-2 ml-auto"
                                placeholder="Cari data">
                            <button type="submit" class="btn btn-success">Cari</button> -->
                    <!-- <?php echo form_close(); ?> -->
                    <!-- </form>
                    </div> -->


                    <!-- <div class="mb-3">
                        <tr>
                            <td colspan="4">
                                <?php $attributes = array('class' => 'row'); ?>
                                <?php echo form_open('admin/peserta', $attributes); ?>
                                <input type="text" name="keyword" placeholder="search" class="form-control col-md-3">
                                <input type="submit" value="Cari" class="btn btn-success col-md-1 ml-3">
                                <?php echo form_close(); ?>
                            </td>
                        </tr>
                    </div> -->

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="py-1 text-center" width="10">No</th>
                                    <th class="py-1 text-center">Identitas</th>
                                    <th class="py-1 text-center">Nama Peserta</th>
                                    <th class="py-1 text-center">Tanggal Lahir</th>
                                    <th class="py-1 text-center">Jenis Kelamin</th>
                                    <th class="py-1 text-center">Prodi</th>
                                    <th class="py-1 text-center">Fakultas</th>
                                    <th class="py-1 text-center">Instansi</th>
                                    <th class="py-1 text-center">Kelas</th>
                                    <th class="py-1 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($peserta as $m) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $m['no_identitas']; ?></td>
                                    <!-- <td class="text-center"><?= $m['nama_peserta']; ?></td> -->
                                    <td class="text-center">
                                        <div class="text-dark"><?= $m['nama_peserta']; ?></div>
                                        <div class="font-weight-light"><?= $m['email']; ?></div>
                                        <div class="font-weight-light"><?= $m['hp']; ?></div>
                                    </td>
                                    <td class="text-center"><?= $m['tgl_lahir']; ?></td>
                                    <td class="text-center"><?= $m['jenis_kelamin']; ?></td>
                                    <td class="text-center"><?= $m['prodi']; ?></td>
                                    <td class="text-center"><?= $m['alias']; ?></td>
                                    <td class="text-center"><?= $m['nama_instansi']; ?></td>
                                    <td class="text-center"><?= $m['nama']; ?></td>

                                    <td class="text-center">
                                        <a href="<?= base_url('admin/editPeserta/') . $m['id']; ?>"><i
                                                class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></span></a>

                                        <a href="<?= base_url('admin/deletePeserta/') . $m['id']; ?>"
                                            class="tombol-delete-fakultas"><i
                                                class="fa fa-trash text-light mx-0 rounded-circle py-2 px-2 bg-danger icon-kelas"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- <?= $this->pagination->create_links(); ?> -->
                        <!-- Batas pagination di bawah -->
                        <!-- <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link bg-primary text-gray-300" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link bg-primary text-gray-300" href="#">Next</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>