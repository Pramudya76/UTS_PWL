<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Daftar Produk</h3>
<div class="row">
    <?php foreach ($barang as $b): ?>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $b['nama'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $b['kategori'] ?></h6>
                    <p class="card-text">
                        Harga: <strong>Rp <?= number_format($b['harga'], 0, ',', '.') ?></strong><br>
                        Stok tersedia: <?= $b['stok'] ?>
                    </p>
                    <a href="#" class="btn btn-primary">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
