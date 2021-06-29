<?= $this->extend('admin/layouts/layout'); ?>

<?= $this->section('style'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="/admin/product">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Produk</h1>
            <p class="mb-0">Form untuk mengubah data produk.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="/admin/product/update/<?= $product['id']; ?>" class="mt-4" enctype="multipart/form-data" method="POST" role="form">
            <?= csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="product-name">Nama Produk</label>
                <input type="text" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" placeholder="Nama Produk" id="product-name" name="product_name" value="<?= (old('product_name')) ? old('product_name') : $product['product_name']; ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('product_name'); ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="product-price">Harga Produk (Rp)</label>
                <input type="text" placeholder="Harga Produk" class="form-control <?= ($validation->hasError('product_price')) ? 'is-invalid' : ''; ?>" id="product-price" name="product_price" value="<?= (old('product_price')) ? old('product_price') : number_format($product['product_price'], 0, '', '.'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('product_price'); ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="product-description">Deskripsi Produk</label>
                <textarea type="text" placeholder="Deskripsi Produk" class="form-control <?= ($validation->hasError('product_description')) ? 'is-invalid' : ''; ?>" id="product-description" name="product_description"><?= (old('product_description')) ? old('product_description') : $product['product_description']; ?></textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('product_description'); ?>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="product-image" class="form-label">Gambar Produk</label>
                <input class="form-control <?= ($validation->hasError('product_image')) ? 'is-invalid' : ''; ?>" type="file" id="product-image" name="product_image">
                <div>
                    <img id="preview-image" src="/img/product/<?= $product['product_image']; ?>" class="col-sm-2 mt-2" alt="Preview Image">
                </div>
                <div class="invalid-feedback">
                    <?= $validation->getError('product_image'); ?>
                </div>
            </div>
            <div class="">
                <a href="/admin/product" class="btn btn-gray-300">Kembali</a>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/assets/vendor/jquery/jquery-3.6.0.js"></script>
<script src="/assets/vendor/jquery-mask/jquery.mask.min.js"></script>

<script>
    $(function() {
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
<?= $this->endSection(); ?>