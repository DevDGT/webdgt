<?= $this->extend('admin/layouts/app'); ?>

<?= $this->section('content') ?>
<div class="container-fluid pb-3">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow mb-0">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
                            <a class="nav-item nav-link" id="nav-socials-tab" data-toggle="tab" href="#nav-socials" role="tab" aria-controls="nav-profile" aria-selected="false">Socials</a>
                            <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false">Password</a>
                            <a class="nav-item nav-link" id="nav-page-tab" data-toggle="tab" href="#nav-page" role="tab" aria-controls="nav-page" aria-selected="false">Halaman Pribadi</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!-- tab profile -->
                        <div class="tab-pane pt-3 show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-2">
                                    <img class="img img-fluid" src="" id="photoProfile">
                                </div>

                                <div class="col-10">
                                    <form id="updateProfile">
                                        <div id="formBody">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- tab profile -->
                        <!-- tab socials -->
                        <div class="tab-pane pt-3" id="nav-socials" role="tabpanel" aria-labelledby="nav-socials-tab">
                            <div class="table-responsive">
                                <div class="float-right ml-3">
                                    <button class="btn btn-sm btn-primary" id="btnAdd" title="Berita Baru">
                                        <i class="fas fa-plus mr-1"> </i>Baru
                                    </button>
                                </div>
                                <table id="listSocials" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Social</th>
                                            <th>Link</th>
                                            <th class="actionField">Aksi</th>
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
                        <!-- tab socials -->
                        <!-- tab password -->
                        <div class="tab-pane pt-3" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                            <form id="formPassword">
                                <div class="form-group">
                                    <label>Masukan Password Lama</label>
                                    <input type="password" name="passwordLama" id="passLama" class="form-control" placeholder="Password" required>
                                    <div id="validate_passwordLama"></div>
                                </div>
                                <div class="form-group">
                                    <label>Masukan Password Baru</label>
                                    <input type="password" name="password" id="passBaru" class="form-control" placeholder="Password" required>
                                    <div id="validate_password"></div>
                                </div>
                                <div class="form-group">
                                    <label>Masukan Lagi Password</label>
                                    <input type="password" name="passwordConfirm" id="confirmPass" class="form-control" placeholder="Password" required>
                                    <div id="validate_passwordConfirm"></div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="btnUbahPass" class="btn btn-primary" disabled="true"> <i class="icon-copy dw dw-paper-plane"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- tab password -->
                        <!-- tab halaman pribadi -->
                        <div class="tab-pane pt-3" id="nav-page" role="tabpanel" aria-labelledby="nav-page-tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-html-tab" data-toggle="pill" href="#pills-html" role="tab" aria-controls="pills-html" aria-selected="true">HTML</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-css-tab" data-toggle="pill" href="#pills-css" role="tab" aria-controls="pills-css" aria-selected="false">CSS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-js-tab" data-toggle="pill" href="#pills-js" role="tab" aria-controls="pills-js" aria-selected="false">JS</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane show active" id="pills-html" role="tabpanel" aria-labelledby="pills-html-tab">
                                    <textarea id="EditorHtml"></textarea>
                                </div>
                                <div class="tab-pane" id="pills-css" role="tabpanel" aria-labelledby="pills-profile-css">
                                    <textarea id="EditorCss"></textarea>
                                </div>
                                <div class="tab-pane" id="pills-js" role="tabpanel" aria-labelledby="pills-contact-js">
                                    <textarea id="EditorJs"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- tab halaman pribadi -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formInput">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="formBodySocials">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('assets/admin/plugins/codemirror/codemirror.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/admin/plugins/codemirror/theme/monokai.css') ?>">
<!-- <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/simplemde/simplemde.min.css') ?>"> -->
<?= $this->endSection(); ?>
<?= $this->section('js') ?>
<script src="<?= base_url('assets/admin/plugins/codemirror/codemirror.js') ?>" defer></script>
<script src="<?= base_url('assets/admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') ?>" defer></script>
<script src="<?= base_url('assets/admin/plugins/codemirror/mode/css/css.js') ?>" defer></script>
<script src="<?= base_url('assets/admin/plugins/codemirror/mode/xml/xml.js') ?>" defer></script>
<script src="<?= base_url('assets/admin/plugins/codemirror/mode/javascript/javascript.js') ?>" defer></script>
<script src="<?= base_url('assets/js/page/admin/profile.js') ?>" defer></script>
<?= $this->endSection() ?>