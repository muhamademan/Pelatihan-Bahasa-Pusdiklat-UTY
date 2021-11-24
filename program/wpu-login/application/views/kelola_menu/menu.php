<div class="container-fluid">
    <div class="col-md-6 mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light">Menu Management</span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#newMenu">Tambah
                            Menu</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="py-1 text-center" width="10">No</th>
                                <th class="py-1 text-center">Nama Menu</th>
                                <th class="py-1 text-center">Active</th>
                                <th class="py-1 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($menu as $m) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $m['menu']; ?></td>
                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input btn-switch-menu item-switch"
                                            id="menucustomSwitch<?= $m['id'] ?>"
                                            <?php if ($m['is_active'] == 1) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>
                                            data="<?= $m['id'] ?>">
                                        <label class="custom-control-label"
                                            for="menucustomSwitch<?= $m['id'] ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('menu/editmenu/') . $m['id']; ?>"><i
                                            class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></span></a>
                                    <a href="<?= base_url('menu/deletemenu/') . $m['id']; ?>" class="hapus-menu"><i
                                            class="fa fa-trash text-light mx-0 rounded-circle py-2 px-2 bg-danger icon-kelas"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Submenu -->
    <div class="col-md-12 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light">Submenu</span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#newSubmenu">Tambah
                            submenu</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="py-1 text-center" width="10">No</th>
                                <th class="py-1 text-center">Menu</th>
                                <th class="py-1 text-center">Submenu</th>
                                <th class="py-1 text-center">URL</th>
                                <th class="py-1 text-center">Icon</th>
                                <th class="py-1 text-center">active</th>
                                <th class="py-1 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($submenu as $sm) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $sm['menu_title']; ?></td>
                                <td class="text-center"><?= $sm['title']; ?></td>
                                <td class="text-center"><?= $sm['url']; ?></td>
                                <td class="text-left"><i class="<?= $sm['icon']; ?> mr-2"></i><?= $sm['icon']; ?></td>
                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input btn-switch-submenu item-switch"
                                            id="submenucustomSwitch<?= $sm['id'] ?>"
                                            <?php if ($sm['is_active'] == 1) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>
                                            data="<?= $sm['id'] ?>">
                                        <label class="custom-control-label"
                                            for="submenucustomSwitch<?= $sm['id'] ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('menu/editsubmenu/') . $sm['id']; ?>"><i
                                            class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></a>
                                    <a href="<?= base_url('menu/deletesubmenu/') . $sm['id']; ?>"
                                        class="hapus-submenu"><i
                                            class="fa fa-trash text-light mx-0 rounded-circle p-2 bg-danger icon-kelas"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu-->
<div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/addmenu'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama menu</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Submenu-->
<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/addsubmenu'); ?>" method="post">
                    <div class="form-group">
                        <label for="Formenu">Pilih menu</label>
                        <select class="form-control" id="Formenu" name="menu_id">
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Nama submenu</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Url</label>
                        <input type="text" name="url" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Icon (fontawesome.com)</label>
                        <input type="text" name="icon" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Buka"
                            value="1">
                        <label class="form-check-label" for="Buka">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Tutup"
                            value="0">
                        <label class="form-check-label" for="Tutup">Non-Active</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>