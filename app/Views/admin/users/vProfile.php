<?= $this->extend('admin/layouts/app'); ?>

<?= $this->section('content') ?>
<div class="container-fluid pb-3">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow mb-0">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
                            <a class="nav-item nav-link" id="nav-socials-tab" data-toggle="tab" href="#nav-socials" role="tab" aria-controls="nav-profile" aria-selected="false">Socials</a>
                            <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-contact" aria-selected="false">Password</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane pt-3 show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-2">
                                    <img class="img img-fluid" src="<?= base_url('uploads/users/default.png') ?>" alt="photo">
                                </div>

                                <div class="col-10">
                                    <form id="updateProfile">

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane pt-3" id="nav-socials" role="tabpanel" aria-labelledby="nav-socials-tab">
                            <div class="table-responsive">
                                <div class="float-right ml-3">
                                    <button class="btn btn-sm btn-primary" id="btnAdd" title="Berita Baru">
                                        <i class="fas fa-plus mr-1"> </i>Baru
                                    </button>
                                </div>
                                <table id="listArticle" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Social</th>
                                            <th>Link</th>
                                            <th id="aksiField">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Social</th>
                                            <th>Link</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane pt-3" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                            <form id="formPassword">
                                <div class="form-group">
                                    <label>Masukan Password Lama</label>
                                    <input type="password" name="passwordLama" id="passLama" class="form-control" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Password Salah !
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Masukan Password Baru</label>
                                    <input type="password" name="password" id="passBaru" class="form-control" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Password minimal 6 karakter
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Masukan Lagi Password</label>
                                    <input type="password" name="passwordConfirm" id="confirmPass" class="form-control" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Password tidak sama !
                                    </div>
                                    <div class="valid-feedback">
                                        Password sama !
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="btnUbahPass" class="btn btn-primary" disabled="true"> <i class="icon-copy dw dw-paper-plane"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/page/admin/profile.js') ?>" defer></script>
<?= $this->endSection() ?>