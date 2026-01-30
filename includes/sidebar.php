<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?php echo ($page == "dashboard")? 'active' : '';  ?>" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Manajemen</div>
                <a class="nav-link <?php echo ($page == "daftar-kategori" || $page =="tambah-kategori" || $page == "ubah-kategori" ) ? "active" : "collapsed" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBuku" aria-expanded="false" aria-controls="collapseBuku">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    kategori
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?php echo ($page == "daftar-kategori" || $page =="tambah-kategori" || $page =="ubah-kategori" ) ? "show" : "" ?>" id="collapseBuku" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?php echo ($page == "daftar-kategori")? 'active' : '';  ?>" href="index.php?hal=daftar-kategori">Daftar Kategori</a>
                        <a class="nav-link <?php echo ($page == "tambah-kategori")? 'active' : '';  ?>" href="index.php?hal=tambah-kategori">Tambah Kategori</a>
                    </nav>
                </div>

                <a class="nav-link <?php echo ($page == "daftar-transaksi" || $page =="tambah-transaksi" || $page == "ubah-transaksi") ? "active" : "collapsed" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    Transaksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?php echo ($page == "daftar-transaksi" || $page =="tambah-transaksi" || $page == "ubah-transaksi") ? "show" : "" ?>" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?php echo ($page == "daftar-transaksi")? 'active' : '';  ?>" href="index.php?hal=daftar-transaksi">Daftar Transaksi</a>
                        <a class="nav-link <?php echo ($page == "tambah-transaksi")? 'active' : '';  ?>" href="index.php?hal=tambah-transaksi">Tambah Transaksi</a>
                    </nav>
                </div>

                <a class="nav-link" href="logout.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                    Logout
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php echo $_SESSION['nama'] ?>

        </div>
    </nav>
</div>
