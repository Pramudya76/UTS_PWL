<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Daftar Transaksi</h3>

<p class="text-muted">
    <?= date("l, d-m-Y") ?> 
    <span id="jam">00</span>:<span id="menit">00</span>:<span id="detik">00</span>
</p>

<div class="table-responsive card p-4">
    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Ongkir</th>
                <th>Status</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($item['username']) ?></td>
                    <td><?= esc($item['alamat']) ?></td>
                    <td><?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                    <td><?= number_format($item['ongkir'], 0, ',', '.') ?></td>
                    <td><?= ucfirst(esc($item['status'])) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($item['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    setInterval(() => {
        const waktu = new Date();
        document.getElementById("jam").textContent = waktu.getHours().toString().padStart(2, '0');
        document.getElementById("menit").textContent = waktu.getMinutes().toString().padStart(2, '0');
        document.getElementById("detik").textContent = waktu.getSeconds().toString().padStart(2, '0');
    }, 1000);
</script>

<?= $this->endSection() ?>
