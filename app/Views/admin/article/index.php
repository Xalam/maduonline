<?= $this->extend('admin/layouts/layout'); ?>

<?= $this->section('style'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<!-- Notyf -->
<link type="text/css" href="/assets/vendor/notyf/notyf.min.css" rel="stylesheet">

<style>
    tbody>tr>td>img {
        max-height: 80px;
    }

    tbody>tr>td {
        vertical-align: middle;
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="py-2">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Tabel Artikel</h1>
            <p class="mb-0">Daftar artikel yang ditampilkan pada website.</p>
        </div>
        <div>
            <a href="#modal-form" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-secondary d-inline-flex align-items-center">
                <i class="fas fa-plus-circle"></i>&nbsp;
                Tambah Artikel
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-article" class="table table-hover table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Gambar</th>
                        <th class="border-0">Judul Artikel</th>
                        <th class="border-0">Isi Artikel</th>
                        <th class="border-0 rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($article as $arc) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><img src="/img/article/<?= $arc['article_image']; ?>" alt="Article Image"></td>
                            <td><?= $arc['article_title']; ?></td>
                            <td><?= $arc['article_content']; ?></td>
                            <td class="text-center">
                                <a href="/admin/article/edit/<?= $arc['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#modal-delete" data-remote="/admin/article/modal/<?= $arc['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script src="/assets/vendor/jquery/jquery-3.6.0.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<!-- Notyf -->
<script src="/assets/vendor/notyf/notyf.min.js"></script>

<script>
    $(function() {
        $('#table-article').DataTable();

        $('#article-image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

<?php if (sizeof($validation->getErrors()) > 0) { ?>
    <script>
        $(function() {
            $('#modal-form').modal('show');
        })
    </script>
<?php } ?>

<?php if (session('success')) { ?>
    <script>
        const notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            types: [{
                type: 'info',
                background: '#42ba96',
                icon: {
                    className: 'fas fa-check-circle',
                    tagName: 'span',
                    color: '#fff'
                },
                dismissible: false
            }]
        });
        notyf.open({
            type: 'info',
            message: '<?= session('success'); ?>'
        });
    </script>
<?php } ?>

<script>
    jQuery(document).ready(function($) {
        $('#modal-delete').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var modal = $(this);

            modal.find('.modal-content').load(button.data("remote"));
        });
    });
</script>

<!-- Modal Insert -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Tambah Artikel</h1>
                    </div>
                    <form action="/admin/article/store" class="mt-4" enctype="multipart/form-data" method="POST" role="form">
                        <?= csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="article-title">Judul Artikel</label>
                            <input type="text" class="form-control <?= ($validation->hasError('article_title')) ? 'is-invalid' : ''; ?>" placeholder="Judul Artikel" id="article-title" name="article_title" value="<?= old('article_title'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('article_title'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="article-content">Konten Artikel</label>
                            <textarea type="text" placeholder="Konten Artikel" class="form-control <?= ($validation->hasError('article_content')) ? 'is-invalid' : ''; ?>" id="article-content" name="article_content"><?= old('article_content'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('article_content'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="article-image" class="form-label">Gambar Artikel</label>
                            <input class="form-control <?= ($validation->hasError('article_image')) ? 'is-invalid' : ''; ?>" type="file" id="article-image" name="article_image">
                            <div>
                                <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" class="col-sm-4 mt-2" alt="Preview Image">
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('article_image'); ?>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-gray-800">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-secondary">
            <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <p class="modal-title text-gray-200" id="modal-title-delete">Hapus data artikel.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>