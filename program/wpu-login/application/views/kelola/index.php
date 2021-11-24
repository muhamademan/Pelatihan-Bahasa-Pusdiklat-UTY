<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <?php
        $Nept = 0;

        $Njpt = 0;
        ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/ept') ?>">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">English
                                    Profeciency Test (EPT)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Nept; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/jpt') ?>">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Japan Profeciency
                                    Test (JPT)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Njpt; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/jpt') ?>">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Japan Profeciency
                                    Test (JPT)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Njpt; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-18">
                    <div class="card-header bg-primary border-bottom-warning">
                        <div class="text-light">Peserta Pelatihan Bahasa <?= date('Y') ?></div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->