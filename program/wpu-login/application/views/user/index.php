<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>


    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-primary"><?= $user['name']; ?></h5>
                    <p class="card-text font-weight-bold"><?= $user['email']; ?></p>
                    <p class="card-text font-weight-bold"><?= $user['jns_kelamin']; ?><br><?= $user['no_hp']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->