<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Selamat Datang, <?= session()->get('username'); ?>!</h2>

    <p>Anda login sebagai <strong><?= session()->get('role'); ?></strong>. Berikut Yang bisa anda lakukan :</p>
    <ul>
        <li><a href="<?= base_url('kelolaBarang') ?>">Kelola Barang</a></li>
        <li><a href="<?= base_url('stokBarang') ?>">Lihat Stok Barang</a></li>
        <li><a href="<?= base_url('pelanggan') ?>">Manajemen Pelanggan</a></li>
    </ul>



<?= $this->endSection() ?>
