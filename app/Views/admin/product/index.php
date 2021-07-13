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
        max-width: 200px;
        vertical-align: middle;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Tabel Produk</h1>
            <p class="mb-0">Daftar produk yang ditampilkan pada website.</p>
        </div>
        <div>
            <a href="#modal-form" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-secondary d-inline-flex align-items-center">
                <i class="fas fa-plus-circle"></i>&nbsp;
                Tambah Produk
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-product" class="table table-hover table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start text-center">#</th>
                        <th class="border-0 text-center">Gambar</th>
                        <th class="border-0 text-center">Nama Produk</th>
                        <th class="border-0 text-center">Harga (Rp)</th>
                        <th class="border-0 text-center">Deskripsi</th>
                        <th class="border-0 rounded-end text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($product as $pro) { ?>
                        <tr>
                            <td width="10%" class="text-center"><?= $no++; ?></td>
                            <td width="15%" class="text-center"><img src="/img/product/<?= $pro['product_image']; ?>" alt="Product Image"></td>
                            <td width="20%"><?= $pro['product_name']; ?></td>
                            <td width="30%" class="text-center"><?= number_format($pro['product_price'], 0, '', '.'); ?></td>
                            <td width="15%"><?= $pro['product_description']; ?></td>
                            <td width="10%" class="text-center">
                                <a href="/admin/product/edit/<?= $pro['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#modal-delete" data-remote="/admin/product/modal/<?= $pro['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
<script src="/assets/vendor/jquery-mask/jquery.mask.min.js"></script>
<script src="https://cdn.tiny.cloud/1/zfkver2ocuzt0kcrwcy1k5p9dh49x0mska1vzokg9vghvuqx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    $(function() {
        $('#table-product').DataTable();

        $('#product-price').mask('#.##0', {
            reverse: true
        });

        $('#product-image').change(function() {
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
<script>
    tinymce.init({
        selector: 'textarea#product-description',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat',
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
                        <h1 class="mb-0 h4">Tambah Produk</h1>
                    </div>
                    <form action="/admin/product/store" class="mt-4" enctype="multipart/form-data" method="POST" role="form">
                        <?= csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="product-name">Nama Produk</label>
                            <input type="text" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" placeholder="Nama Produk" id="product-name" name="product_name" value="<?= old('product_name'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('product_name'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="product-price">Harga Produk (Rp)</label>
                            <input type="text" placeholder="Harga Produk" class="form-control <?= ($validation->hasError('product_price')) ? 'is-invalid' : ''; ?>" id="product-price" name="product_price" value="<?= old('product_price'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('product_price'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="product-description">Deskripsi Produk</label>
                            <textarea type="text" placeholder="Deskripsi Produk" class="form-control <?= ($validation->hasError('product_description')) ? 'is-invalid' : ''; ?>" id="product-description" name="product_description"><?= old('product_description'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('product_description'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="product-image" class="form-label">Gambar Produk</label>
                            <input class="form-control <?= ($validation->hasError('product_image')) ? 'is-invalid' : ''; ?>" type="file" id="product-image" name="product_image">
                            <div>
                                <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" class="col-sm-4 mt-2" alt="Preview Image">
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('product_image'); ?>
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
                <p class="modal-title text-gray-200" id="modal-title-delete">Hapus data produk.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>