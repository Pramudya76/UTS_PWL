<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Table Data Barang Sembako -->
<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Tanggal Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($barang as $b): ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $b['nama'] ?></td>
                <td><?= $b['kategori'] ?></td>
                <td><?= $b['stok'] ?></td>
                <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                <td><?= $b['tanggal_masuk'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
