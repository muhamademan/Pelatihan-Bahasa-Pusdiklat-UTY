<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mt-5">
                <div class="p-5">
                    <div class="text-center">
                        <a href="<?= base_url(''); ?>">
                            <img src="<?= base_url('assets/img/uty.png'); ?>" alt="" height="70" class="mx-3">
                        </a>
                        <h1 class="h4 text-light font-weight-bold mb-4 mt-3">Halaman Lupa Password</h1>
                    </div>
                    <?php $cek1 = $this->session->userdata('email'); ?>
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="post" action="<?= base_url("reset_pass/updatePass"); ?>">
                        <div class="form-group">
                            <input type="text"
                                class="form-control shadow text-primary form-control-user font-weight-bold" id="email"
                                name="email" placeholder="<?= $cek1; ?>" value="<?= $cek1; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text"
                                class="form-control shadow text-primary form-control-user font-weight-bold" id="email"
                                name="password" placeholder="Masukan password baru">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block shadow font-weight-bold">
                            Ganti Password
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small text-warning font-weight-bold" href="<?= base_url('auth/logout'); ?>">Keluar</a>

                        <!-- Copyright Pusdiklat -->
                        <div class="row mt-3">
                            <div class="col-md-12 mt-3 pt-5 text-center text-light">
                                <span class="px-2 py-0 rounded">Pusdiklat & Sertifikasi UTY &copy;
                                    <?= date('Y'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>