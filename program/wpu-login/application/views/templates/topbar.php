        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->

                    <div class="small mb-0">
                        <h1 class="h3 mb-1 text-gray-800 font-weight-bold"><?= $title; ?></h1>
                        <span class="font-weight-bold text-primary"><?= date('d F Y · h : i'); ?></span>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <?php if ($user['role_id'] == 1) : ?>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Bell Notification -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>

                                <!-- Counter - Alerts -->
                                <?php foreach ($jumlah as $j) : ?>
                                <span class="badge badge-danger badge-counter"><?= $j['jumlah']; ?></span>
                                <?php endforeach ?>
                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi Pelatihan Bahasa
                                </h6>

                                <?php foreach ($nama as $d) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $d['tanggal']; ?>
                                        </div>
                                        Sisa Kuota <?= $d['nama']; ?> Masih <?= $d['sisa_kuota']; ?>, <b>Tutup</b> atau
                                        <b>Perpanjang tanggal pelaksanaan</b>.
                                    </div>
                                </a>
                                <?php endforeach ?>
                                <?php if ($j['jumlah'] == 0) : ?>
                                <a class="dropdown-item text-center small text-gray-500">Tidak ada
                                    notifikasi</a>
                                <?php else : ?>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="<?= base_url('admin/jadwalkelas'); ?>">Notifikasi
                                    lainnya</a>
                                <?php endif; ?>
                            </div>
                        </li>

                        <?php endif; ?>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('auth/profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->