<?= $this->extend('admin/layouts/layout'); ?>

<?= $this->section('style'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="/admin/article">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Artikel</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Artikel</h1>
            <p class="mb-0">Form untuk mengubah artikel.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="/admin/article/update/<?= $article['id']; ?>" class="mt-4" enctype="multipart/form-data" method="POST" role="form">
            <?= csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="article-title">Judul Artikel</label>
                <input type="text" class="form-control <?= ($validation->hasError('article_title')) ? 'is-invalid' : ''; ?>" placeholder="Judul Artikel" id="article-title" name="article_title" value="<?= (old('article_title')) ? old('article_title') : $article['article_title']; ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('article_title'); ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="article-content">Konten Artikel</label>
                <textarea type="text" placeholder="Konten Artikel" class="form-control <?= ($validation->hasError('article_content')) ? 'is-invalid' : ''; ?>" id="article-content" name="article_content"><?= (old('article_content')) ? old('article_content') : $article['article_content']; ?></textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('article_content'); ?>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="article-image" class="form-label">Gambar Arikel</label>
                <input class="form-control <?= ($validation->hasError('article_image')) ? 'is-invalid' : ''; ?>" type="file" id="article-image" name="article_image">
                <div>
                    <img id="preview-image" src="/img/article/<?= $article['article_image']; ?>" class="col-sm-2 mt-2" alt="Preview Image">
                </div>
                <div class="invalid-feedback">
                    <?= $validation->getError('article_image'); ?>
                </div>
            </div>
            <div class="">
                <a href="/admin/article" class="btn btn-gray-300">Kembali</a>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/assets/vendor/jquery/jquery-3.6.0.js"></script>

<script>
    $(function() {

        $('#article-image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
<?= $this->endSection(); ?>