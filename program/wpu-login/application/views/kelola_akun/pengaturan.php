<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('admin/pengaturan'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email"
                        value="<?php echo $user['email']; ?>" readonly>
                </div>

            </div>
            <div class="form-group row">

                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-sm-2">Gambar</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>"
                                class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <input type="file" class="custom-custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <label for="current_password" class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">

                <label for="new_password1" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">

                <label for="new_password2" class="col-sm-2 col-form-label">Ulangi Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>


            </form>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->