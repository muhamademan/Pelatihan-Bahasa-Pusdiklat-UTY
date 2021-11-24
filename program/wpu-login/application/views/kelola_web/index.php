<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Jumlah Admin Sistem Pelatihan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('akun/admin') ?>">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin Sistem
                                </div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $admin_sistem = COUNT($admin_sistem); ?> Admin
                                Sistem
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Admin Pusdiklat UTY -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('akun/admin') ?>">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Admin Pusdiklat
                                    UTY
                                </div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $admin_pusdiklat = COUNT($admin_pusdiklat); ?> Admin Pusdiklat</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Jumlah Mentor Pelatihan Bahasa -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('akun/admin') ?>">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Mentor Pelatihan
                                    Bahasa</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mentor = COUNT($mentor); ?>
                                Mentor
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>