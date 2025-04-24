<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Daftar Pelanggan</h3>

<table class="table datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($dataUser as $user): ?>
            <?php if ($user['role'] == 'user'): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user['username'] ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
