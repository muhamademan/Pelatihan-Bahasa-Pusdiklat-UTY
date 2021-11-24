<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('user/edit'); ?>
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
                            <label class="custom-file-label" for="image">Pilih gambar</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit " class="btn btn-success btn-block">Simpan</button>
                </div>
            </div>


            </form>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->