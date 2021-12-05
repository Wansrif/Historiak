<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand text-uppercase" href="\">HistoriaKHB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto text-capitalize">
        <a class="nav-link active" aria-current="page" href="\">Beranda</a>
        <div class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">Sejarah</a>
          <ul class=" dropdown-menu text-capitalize" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?= base_url('kerajaan'); ?>">Kerajaan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('tokohkerajaan'); ?>">Tokoh Kerajaan</a></li>
          </ul>
        </div>
        <a class="nav-link active" href="<?= base_url('galeri'); ?>">galeri</a>
        <a class="nav-link active" href="<?= base_url('kuis'); ?>">kuis</a>
        <a class="nav-link active" href="<?= base_url('kontak'); ?>">kontak</a>
        <a class="nav-link active" href="<?= base_url('tentang'); ?>">tentang</a>
        <?php if(logged_in()) : ?>
        <a class="nav-link active" href="<?= base_url('dashboard'); ?>">Dashboard</a>
        <?php else : ?>
        <a class="nav-link active" href="<?= base_url('login'); ?>">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>