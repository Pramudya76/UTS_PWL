<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!-- Table Data Barang Sembako -->
<h3>Selamat Datang di <strong>Toko Saudara</strong></h3>
<br>
<p>Kami menyediakan berbagai kebutuhan sembako, makanan ringan, dan kebutuhan sehari-hari dengan harga terjangkau. Toko Saudara berkomitmen untuk selalu memberikan produk berkualitas dan pelayanan terbaik untuk setiap pelanggan kami.</p>
<br>
<h4>Kenapa Belanja di Toko Saudara?</h4>
<ul>
    <li>Produk Berkualitas dan Terjamin</li>
    <li>Harga Terjangkau dan Bersaing</li>
    <li>Pengiriman Cepat dan Aman</li>
    <li>Diskon dan Promosi Menarik Setiap Minggu</li>
</ul>

<div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="..." width="100%">
                    <h5 class="card-title"><?php echo $item['nama'] ?><br><?php echo $item['harga'] ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>


<!-- End Table -->
<?= $this->endSection() ?>
