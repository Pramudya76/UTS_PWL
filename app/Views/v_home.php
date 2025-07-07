<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <?php foreach ($product as $key => $item): ?>
        <div class="col-lg-6">
            <?= form_open('keranjang') ?>
            <?= form_hidden('id', $item['id']) ?>
            <?= form_hidden('nama', $item['nama']) ?>
            <?= form_hidden('harga', $item['harga']) ?>
            <?= form_hidden('foto', $item['foto']) ?>
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url("img/" . $item['foto']) ?>" alt="..." width="300px">
                    <h5 class="card-title"><?= $item['nama'] ?><br><?= number_to_currency($item['harga'], 'IDR') ?></h5>
                    <p>Stok: <strong><?= $item['jumlah'] ?></strong></p>

                    <?php if ($item['jumlah'] > 0): ?>
                        <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-danger rounded-pill" disabled>Stok Habis</button>
                    <?php endif; ?>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>
