<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Halo, <?= esc($username) ?>!</h2>

<p><?= esc($message) ?></p>
<p>Anda login sebagai <strong><?= esc($role) ?></strong>. Berikut menu yang bisa Anda akses:</p>

<ul>
    <?php foreach ($menu as $item): ?>
        <li><?= esc($item) ?></li>
    <?php endforeach; ?>
</ul>

<?= $this->endSection() ?>
