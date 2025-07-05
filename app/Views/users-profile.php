<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= base_url('img/' . ($user['username'] ?? 'default') . '.jpg') ?>" alt="Profile" class="rounded-circle" width="150">
                    <h2><?= esc($user['username']) ?></h2>
                    <h3><?= esc($user['role']) ?></h3>
                    <p>Created at: <?= esc($user['created_at']) ?></p>
                    <p>Updated at: <?= esc($user['updated_at']) ?></p>

                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">

                    <?php if (session()->getFlashData('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
                    <?php elseif (session()->getFlashData('failed')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashData('failed') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('usersProfile/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <div class="mb-2">
                                <img src="<?= base_url('img/' . ($user['username'] ?? 'default') . '.jpg') ?>" width="100">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="check" value="1" id="checkFoto">
                                <label for="checkFoto" class="form-check-label">Ceklis jika ingin mengganti foto</label>
                            </div>
                            <input type="file" class="form-control" name="foto">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

</main>

<?= $this->endSection() ?>
