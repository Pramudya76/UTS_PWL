<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>History Transaksi Pembelian <strong><?= $username ?></strong></h3>
<hr>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Pembelian</th>
                <th>Waktu Pembelian</th>
                <th>Total Bayar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buy)) : ?>
                <?php foreach ($buy as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['created_at'] ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= $item['alamat'] ?></td>
                        <td>
                            <?php if ($item['status'] == "1"): ?>
                                <span class="badge bg-success">Sudah Selesai</span>
                            <?php elseif ($item['status'] == "2"): ?>
                                <span class="badge bg-danger">Dibatalkan</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Belum Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Detail Transaksi -->
                    <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Transaksi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php 
                                    if (!empty($product) && isset($product[$item['id']])) :
                                        foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                            <?= $index2 + 1 ?>)
                                            <?php if ($item2['foto'] != '' && file_exists("img/" . $item2['foto'])) : ?>
                                                <img src="<?= base_url("img/" . $item2['foto']) ?>" width="100px">
                                            <?php endif; ?>
                                            <strong><?= $item2['nama'] ?></strong>
                                            <?= number_to_currency($item2['harga'], 'IDR') ?><br>
                                            (<?= $item2['jumlah'] ?> pcs)<br>
                                            <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                            <hr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <p>Ongkir: <?= number_to_currency($item['ongkir'], 'IDR') ?></p>
                                </div>
                                <div class="modal-footer">
                                    <?php if ($item['status'] == "0") : ?>
                                        <a href="<?= base_url('transaksi/batalkan/' . $item['id']) ?>" class="btn btn-danger">
                                            Batalkan Transaksi
                                        </a>
                                        <a href="<?= base_url('transaksi/selesaikan/' . $item['id']) ?>" class="btn btn-primary">
                                            Selesaikan Transaksi
                                        </a>
                                    <?php elseif ($item['status'] == "2") : ?>
                                        <button class="btn btn-danger" disabled>Transaksi Dibatalkan</button>
                                    <?php else : ?>
                                        <button class="btn btn-success" disabled>Transaksi Sudah Selesai</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
