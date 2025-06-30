<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Daftar Users</h3>

<table class="table datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
