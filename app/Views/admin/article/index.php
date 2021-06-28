<?= $this->extend('admin/layouts/layout'); ?>

<?= $this->section('style'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="py-2">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Tabel Artikel</h1>
            <p class="mb-0">Daftar artikel yang ditampilkan pada website.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-product" class="table table-hover table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Gambar</th>
                        <th class="border-0">Judul Artikel</th>
                        <th class="border-0">Isi Artikel</th>
                        <th class="border-0 rounded-end">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script src="/assets/vendor/jquery/jquery-3.6.0.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $('#table-product').DataTable();
    });
</script>
<?= $this->endSection(); ?>