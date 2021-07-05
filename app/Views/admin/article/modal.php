<button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="modal-header">
    <p class="modal-title text-gray-200" id="modal-title-delete">Hapus data artikel.</p>
</div>
<div class="modal-body text-white">
    <div class="py-3 text-center">
        <span class="modal-icon">
            <i class="fas fa-trash-alt fa-5x"></i>
        </span>
        <h2 class="h4 modal-title my-3">Peringatan!</h2>
        <p>Apakah Anda ingin menghapus artikel <strong><?= $article['article_title']; ?></strong>?</p>
    </div>
</div>
<form action="/admin/article/delete/<?= $article['id']; ?>" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="DELETE">
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-white">Hapus</button>
    </div>
</form>