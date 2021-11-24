<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Nama kelas pelatihan bahasa tidak boleh sama.
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning text-right">
                    <a href="" class="btn btn-success py-1 my-0 border-dark" data-toggle="modal"
                        data-target="#newKelasModal">Tambah Kelas</a>

                </div>
                <div class="card-body">
                    <table class="table table-hover" id="example">
                        <thead>

                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Kuota</th>
                                <th scope="col">Sisa Kuota</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Status Kelas</th>
                                <th scope="col">Nama Mentor</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($kelas as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $k['nama']; ?></td>
                                <td><?= $k['ruangan']; ?></td>
                                <td><?= $k['lokasi']; ?></td>
                                <td><?= $k['kuota']; ?></td>
                                <td><?= $k['sisa_kuota']; ?></td>
                                <!-- <td><?= date('d M Y', $k['tanggal']); ?></td> -->
                                <td><?= $k['tanggal']; ?></td>

                                <td>
                                    <?php
                                        $a = 15;
                                        date_default_timezone_set('asia/jakarta');
                                        $aa = date('Y-m-d');
                                        // echo $aa;
                                        ?>


                                    <?php if ($k['status'] == "Tutup" || $k['sisa_kuota'] == "0" || $k['sisa_kuota'] < 10 && $k['tanggal'] == $aa) : ?>
                                    <div class="badge badge-danger">Tutup</div>
                                    <?php else : ?>
                                    <div class="badge badge-success">Buka</div>
                                    <?php endif ?>
                                </td>

                                <!-- <td>
                                    <?php if ($k['status'] == "Buka") : ?>
                                    <div class="badge badge-success"><?= $k['status']; ?></div>
                                    <?php elseif ($k['status'] == "Penuh") : ?>
                                    <div class="badge badge-danger"><?= $k['status']; ?></div>
                                    <?php elseif ($k['status'] == "Perpanjang") : ?>
                                    <div class="badge badge-warning"><?= $k['status']; ?></div>
                                    <?php else : ?>
                                    <div class="badge badge-danger"><?= $k['status']; ?></div>
                                    <?php endif ?>
                                </td> -->

                                <td>
                                    <?php foreach ($mentor as $p) : ?>
                                    <?php if ($p['id'] == $k['user_id']) : ?>
                                    <?= $p['username'] ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if ($k['user_id'] == 0) : ?>
                                    <span class="text-danger">Null</span>
                                    <?php endif; ?>
                                </td>
                                <td>

                                    <!-- Edit Kelas -->
                                    <a class="fa fa-edit text-light mx-0 rounded-circle p-2 bg-success icon-kelas"
                                        data-toggle="modal" data-target="#editKelas<?= $k['id'] ?>" href="">

                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>

                                    <div class="modal fade" id="editKelas<?= $k['id'] ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="editKelas" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editKelas">Edit
                                                        Kelas
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('admin/edit_kelas'); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Nama
                                                                Kelas</label>
                                                            <input type="text" class="form-control" id="nama_kelas"
                                                                name="nama_kelas" value="<?= $k['nama'] ?>" required
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Nama
                                                                Ruangan</label>
                                                            <input type="text" class="form-control" id="nama_ruangan"
                                                                name="nama_ruangan" value="<?= $k['ruangan'] ?>"
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-sm">
                                                                <select class="custom-select" id="lokasi" name="lokasi"
                                                                    required
                                                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                    oninput="setCustomValidity('')">
                                                                    <?php if ($k['lokasi'] == "Kampus 1 UTY") : ?>
                                                                    <option value="" disabled>
                                                                        ---Pilih
                                                                        Lokasi---
                                                                    </option>
                                                                    <option selected value="Kampus 1 UTY">
                                                                        Kampus 1
                                                                        UTY
                                                                    </option>
                                                                    <option value="Kampus 2 UTY">
                                                                        Kampus
                                                                        2 UTY</option>
                                                                    <option value="Kampus 3 UTY">
                                                                        Kampus
                                                                        3 UTY</option>
                                                                    <?php elseif ($k['lokasi'] == "Kampus 2 UTY") : ?>
                                                                    <option value="" disabled>
                                                                        ---Pilih
                                                                        Lokasi---
                                                                    </option>
                                                                    <option value="Kampus 1 UTY">
                                                                        Kampus
                                                                        1 UTY</option>
                                                                    <option selected value="Kampus 2 UTY">
                                                                        Kampus 2
                                                                        UTY
                                                                    </option>
                                                                    <option value="Kampus 3 UTY">
                                                                        Kampus
                                                                        3 UTY</option>
                                                                    <?php elseif ($k['lokasi'] == "Kampus 3 UTY") : ?>
                                                                    <option value="" disabled>
                                                                        ---Pilih
                                                                        Lokasi---
                                                                    </option>
                                                                    <option value="Kampus 1 UTY">
                                                                        Kampus
                                                                        1 UTY</option>
                                                                    <option value="Kampus 2 UTY">
                                                                        Kampus
                                                                        2 UTY</option>
                                                                    <option selected value="Kampus 3 UTY">
                                                                        Kampus 3
                                                                        UTY
                                                                    </option>
                                                                    <?php else : ?>
                                                                    <option value="" selected disabled>
                                                                        ---Pilih
                                                                        Lokasi---</option>
                                                                    <option value="Kampus 1 UTY">
                                                                        Kampus
                                                                        1 UTY</option>
                                                                    <option value="Kampus 2 UTY">
                                                                        Kampus
                                                                        2 UTY</option>
                                                                    <option value="Kampus 3 UTY">
                                                                        Kampus
                                                                        3 UTY</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" id="id" name="id"
                                                                value="<?= $k['id'] ?>">
                                                            <label for="exampleInputNama">Kuota</label>
                                                            <input type="text" class="form-control" id="kuota"
                                                                name="kuota" value="<?= $k['kuota'] ?>" required
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Sisa
                                                                Kuota</label>
                                                            <input type="disable" class="form-control" id="sisa_kuota"
                                                                name="sisa_kuota" value="<?= $k['sisa_kuota'] ?>"
                                                                required
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Tanggal
                                                                Pelaksanaan</label>
                                                            <input type="date" class="form-control" id="tanggal_ujian"
                                                                name="tanggal_ujian" value="<?= $k['tanggal'] ?>"
                                                                required
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="form-group">
                                                            <select name="status_kelas" class="form-control"
                                                                id="id_status_kelas" required
                                                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                                                oninput="setCustomValidity('')">
                                                                <!-- <option value selected disabled="<?= $k['status'] ?>">
                                                                    <?= $k['status'] ?></option> -->
                                                                <option value="Buka">Buka</option>
                                                                <?php if ($k['sisa_kuota'] == 0) : ?>
                                                                <option value="Tutup">Tutup</option>
                                                                <?php endif; ?>
                                                                <!-- <option value="Perpanjang">Perpanjang</option> -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="mentor">Pilih Mentor</label>
                                                            <select class="form-control" name="mentor" id="mentor">
                                                                <?php foreach ($mentor as $p) : ?>
                                                                <option value="<?= $p['id'] ?>"
                                                                    <?php if ($p['id'] == $k['user_id']) : ?> selected
                                                                    <?php endif; ?>>
                                                                    <?= $p['username'] ?>
                                                                </option>
                                                                <?php endforeach; ?>
                                                                <?php if ($k['user_id'] == 0) : ?>
                                                                <option value="0" selected>-
                                                                </option>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hapus -->

                                    <a class="fa fa-trash text-light mx-0 rounded-circle p-2 bg-danger icon-kelas"
                                        onclick="javascript: return confirm('Anda yakin akan menghapus kelas ini? ')"
                                        href="<?= base_url('admin/hapus_kelas/' . $k['id']) ?>">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </sb-ng-bootstrap-table>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Kelas-->
<div class="modal fade" id="newKelasModal" tabindex="-1" role="dialog" aria-labelledby="newKelasModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKelasModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form class="user" action="<?php base_url('admin/jadwalkelas'); ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas Pelatihan</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                            placeholder="Nama Kelas" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="nama_ruangan">Ruangan Pelatihan</label>
                        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan"
                            placeholder="Nama Ruangan" oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Pelatihan</label>
                        <select name="lokasi" id="lokasi" class="form-control" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                            <option selected disabled value="">---Lokasi---</option>
                            <option value="Kampus 1 UTY">Kampus 1 UTY</option>
                            <option value="Kampus 2 UTY">Kampus 2 UTY</option>
                            <option value="Kampus 3 UTY">Kampus 3 UTY</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota Kelas Pelatihan</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" placeholder="Kuota" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ujian">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tanggal_ujian" name="tanggal_ujian" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="status_kelas">Status Kelas Pelatihan</label>
                        <select class="form-control" name="status_kelas" id="status_kelas" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                            <option selected disabled value="">---Pilih Status Kelas---</option>
                            <option value="Buka">Buka</option>
                            <option value="Penuh">Penuh</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Tambahkan</button>
            </div>
            </form>
            <!-- endform -->
        </div>
    </div>
</div>