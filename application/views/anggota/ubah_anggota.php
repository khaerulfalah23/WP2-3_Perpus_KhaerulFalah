<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
            </div>
            <?php }?>
            <?= $this->session->flashdata('pesan'); ?>


            <!-- KOnten -->
            <form action="<?= base_url('anggota/ubahAnggota/'. $anggota['id']); ?>" method="post" enctype="multipart/form-data">
                <div class='row'>
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/profile/') . $anggota['image']; ?>" class="img-thumbnail" alt="">
                    </div>
                    <div class='col-sm-9'>
                        <div class="modal-body">
                            <input type="hidden" class="form-control form-control-user" id="id"
                                name="id" value="<?= $anggota['id']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama"
                                    name="nama" placeholder="Masukkan nama anggota"
                                    value="<?= $anggota['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email"
                                    name="email" placeholder="Masukkan email anggota" value='<?= $anggota['email']; ?>'>
                            </div>
                            <div class="form-group">
                                <select name="status" class="form-control form-control-user">
                                  <option value="1" <?= ($anggota['is_active'] == 1) ? 'selected' : '' ?> >active</option>
                                  <option value="0" <?= ($anggota['is_active'] == 1) ? '' : 'selected' ?> >nonactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control form-control-user" id="image" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back(-1)"><i
                                    class="fas fa-ban"></i>Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                                Update</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->