<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control'
];

$email = [
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'type' => 'email'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];

$confirm_password = [
    'name' => 'confirm_password',
    'id' => 'confirm_password',
    'class' => 'form-control'
];
?>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="<?php echo base_url() ?>NiceAdmin/assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Toko Saudara</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create Your Account</h5>
                    <p class="text-center small">Enter your details to register</p>
                  </div>

                    <?php
                        if (session()->getFlashData('failed')) {
                        ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php
                        }
                    ?>

                    <?= form_open('register', 'method="post" class="row g-3 needs-validation"') ?>

                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <?= form_input($username) ?>
                            <div class="invalid-feedback">Please enter a username.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourEmail" class="form-label">Email</label>
                        <?= form_input($email) ?>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <?= form_password($password) ?>
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <?= form_password($confirm_password) ?>
                        <div class="invalid-feedback">Please confirm your password!</div>
                    </div>

                    <div class="col-12">
                        <?= form_submit('submit', 'Register', ['class' => 'btn btn-primary w-100']) ?>
                    </div>
                    <div class="col-12 text-center">
                        <p class="small mb-0">Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
                    </div>

                    <?= form_close() ?>

            </div>
            </div>

            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

        </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
