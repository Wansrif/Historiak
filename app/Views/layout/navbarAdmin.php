<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top topbar">
  <div class="container-fluid">
    <a class="navbar-brand text-uppercase" href="#">

      <!-- offcanvas trigger -->
      <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
      </button>
      <!-- end offcanvas trigger -->

      <img src="<?= base_url('img/history.png'); ?>" alt="Administrator"
        class="d-inline-block align-text-top history"><span class="adminNav ml-1">Administrator</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link active text-center" href="<?= base_url('logout'); ?>">Logout <i
            class="bi bi-box-arrow-right"></i></a>
      </div>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<!-- Offcanvas -->
<div class="offcanvas offcanvas-start text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
  aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close text-reset tombol-tutup" data-bs-dismiss="offcanvas"
      aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <nav class="navbar-dark">
      <div class="navbar-nav text-uppercase sidenav">
        <hr>
        <a class="nav-link active px-3" href="<?= base_url('dashboard'); ?>"><i class='bx-fw bx bxs-dashboard'></i>
          Dashboard</a>
        <hr>
        <a class="nav-link active px-3" href="<?= base_url('kerajaanadmin'); ?>"><i class="bi bi-folder2"></i>
          Kerajaan</a>
        <a class="nav-link active px-3" href="<?= base_url('tokohadmin'); ?>"><i class="bi bi-book"></i> Tokoh
          Kerajaan</a>
        <hr>
        <a class="nav-link active px-3" href="<?= base_url('galeriadmin'); ?>"><i class="bi bi-x-diamond"></i>
          Galeri</a>
        <a class="nav-link active px-3" href="<?= base_url('kuisadmin'); ?>"><i class='bx bx-book-reader'></i> Kuis</a>
        <hr>
        <a class="nav-link active px-3" href="<?= base_url('pesan'); ?>"><i class="bi bi-envelope"></i> Pesan</a>
        <hr>
      </div>
    </nav>
  </div>
</div>
<!-- End Offcanvas -->