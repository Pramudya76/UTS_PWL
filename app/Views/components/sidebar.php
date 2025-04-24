<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
                <i class="bi bi-receipt"></i>
                <span>Produk</span>
            </a>
        </li><!-- End Produk Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
                <i class="bi bi-cart-check"></i>
                <span>Keranjang</span>
            </a>
        </li><!-- End Keranjang Nav -->

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'dashboard') ? "" : "collapsed" ?>" href="dashboard">
                    <i class="bi bi-receipt"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php
        }
        ?>

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'pelanggan') ? "" : "collapsed" ?>" href="pelanggan">
                    <i class="bi bi-receipt"></i>
                    <span>Pelanggan</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php
        }
        ?>
        
        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'stokBarang') ? "" : "collapsed" ?>" href="stokBarang">
                    <i class="bi bi-receipt"></i>
                    <span>Stok Barang</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php
        }
        ?>

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'riwayatBelanja') ? "" : "collapsed" ?>" href="riwayatBelanja">
                <i class="bi bi-receipt"></i>
                <span>Riwayat Pembelian</span>
            </a>
        </li><!-- End Produk Nav -->
        

    </ul>

</aside><!-- End Sidebar-->