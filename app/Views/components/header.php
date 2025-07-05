<?php
  use App\Models\TransactionModel;

  $username = session()->get('username');
  $role = session()->get('role');

  $model = new TransactionModel();

  if ($role === 'admin') {
      // Kalau admin, ambil semua transaksi
      $notif = $model->orderBy('created_at', 'DESC')->findAll(3);
  } else {
      $notif = $model->where('username', $username)->orderBy('created_at', 'DESC')->findAll(3);
  }
?>



<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="/" class="logo d-flex align-items-center">
    <img src="<?= base_url()?>NiceAdmin/assets/img/Logo_Toko_Saudara.png" alt="">
    <span class="d-none d-lg-block">Toko Saudara</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?= count($notif) ?></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
                Ada <?= count($notif ?? []) ?> transaksi baru
            </li>

            <li><hr class="dropdown-divider"></li>

            <?php if (!empty($notif)): ?>
                <?php foreach ($notif as $item): ?>
                    <li class="notification-item">
                        <i class="bi bi-cart-check text-success"></i>
                        <div>
                            <h4>ID: <?= esc($item['id']) ?></h4>
                            <p><?= esc($item['alamat']) ?></p>
                            <p><?= date('d M Y H:i', strtotime($item['created_at'])) ?></p>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="notification-item">
                    <div>
                        <h4>Tidak ada transaksi</h4>
                    </div>
                </li>
            <?php endif; ?>

            <li class="dropdown-footer">
              <?php
              if (session()->get('role') == 'admin') {
              ?>
                <a href="dataTransaksi">Tampilkan semua transaksi</a>
              <?php
              }
              ?>
              <?php
              if (session()->get('role') == 'guest') {
              ?>
                <a href="profile">Tampilkan semua transaksi</a>
              <?php
              }
              ?>
            </li>
        </ul>
    </li>



    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url('img/' . esc(session()->get('username')) . '.jpg') ?>" alt="Profile" class="rounded-circle" width="35" height="35">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('username'); ?> (<?= session()->get('role'); ?>)</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?= session()->get('username'); ?></h6>
          <span><?= session()->get('role'); ?></span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="usersProfile">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->