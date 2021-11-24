    <div class="bg-gradient-primary">
        <!-- <div class="bg-login-image"> -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <table class="mb-5">
                        <div class="row">
                            <div class="p-5">
                                <tr>
                                    <td>
                                        <a href="<?= base_url(''); ?>">
                                            <img src="<?= base_url('assets/img/uty.png'); ?>" alt="" height="70"
                                                class="mr-3">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h4 class="text-base text-light text-uppercase mb-1 font-weight-bold">Login
                                                Pelatihan Bahasa</h4>
                                            <p class="text-base text-light text-uppercase mb-0">Universitas Teknologi
                                                Yogyakarta
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        </div>
                    </table>
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                        <div class="form-group">
                            <input type="text"
                                class="form-control shadow text-primary form-control-user font-weight-bold" id="email"
                                name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control shadow text-primary form-control-user font-weight-bold"
                                id="password" name="password" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block shadow font-weight-bold">
                            LOGIN
                        </button>
                    </form>

                    <!-- Lupa Password -->
                    <hr>
                    <div class="text-center">
                        <a class="small text-warning font-weight-bold"
                            href="<?= base_url('auth/lupa_password'); ?>">Lupa
                            Password?</a>
                    </div>

                    <!-- Copyright -->
                    <div class="row mt-4">
                        <div class="col-md-12 mt-5 pt-5 text-center text-light">
                            <span class="px-2 py-0 rounded">Pusdiklat & Sertifikasi UTY &copy; <?= date('Y'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>