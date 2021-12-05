<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main>
  <!-- Jumbotron -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">SEJARAH KERAJAAN<br>HINDU-BUDHA</h1>
    </div>
  </div>
  <!-- jumbotron -->

  <!-- Artikel -->
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <h4 class="judul">Artikel Terbaru</h4>
      </div>
    </div>
    <div class="row justify-content-around">
      <?php foreach ($kerajaan as $k) : ?>
      <div class="col-md-6 mb-4">
        <div class="card text-white h-100">
          <a href="<?= base_url('kerajaan'); ?>/<?= $k['slug']; ?>" class="text-reset">
            <img src="<?= base_url('img/kerajaan'); ?>/<?= $k['gambar']; ?>" class="card-img gmbr"
              alt="Gambar Kerajaan">
            <div class="card-img-overlay">
              <div class="konten">
                <h5 class="card-title"><?= $k['judul']; ?></h5>
                <p class="card-text"><?= word_limiter($k['isi'], 10, '...'); ?></p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endForeach; ?>
    </div>

    <div class="row justify-content-around">
      <?php foreach ($tokoh as $t) : ?>
      <div class="col-md-6 mb-4">
        <div class="card text-white h-100">
          <a href="<?= base_url('tokohkerajaan'); ?>/<?= $t['slug']; ?>" class="text-reset">
            <img src="<?= base_url('img/tokoh'); ?>/<?= $t['gambar']; ?>" class="card-img gmbr" alt="Gambar Tokoh">
            <div class="card-img-overlay">
              <div class="konten">
                <h5 class="card-title"><?= $t['judul']; ?></h5>
                <p class="card-text"><?= word_limiter($t['isi'], 10, '...'); ?></p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endForeach; ?>
    </div>

    <div class="row justify-content-around">
      <?php foreach ($galeri as $g) : ?>
      <div class="col-md-6 mb-4">
        <div class="card text-white h-100">
          <a href="<?= base_url('galeri'); ?>/<?= $g['slug']; ?>" class="text-reset">
            <img src="<?= base_url('img/galeri'); ?>/<?= $g['gambar']; ?>" class="card-img gmbr" alt="Gambar Galeri">
            <div class="card-img-overlay">
              <div class="kontenGaleri">
                <h5 class="card-title"><?= $g['judul']; ?></h5>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endForeach; ?>
    </div>

  </div>
  <!-- End Artikel-->
</main>
<?= $this->endSection(); ?>