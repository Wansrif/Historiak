<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="max-width: 85%;">
  <div class="row">
    <div class="col">
      <div class="judul">
        <h1 class="my-4 text-center">Galeri</h1>
      </div>
    </div>
  </div>
  <div class="col-md-5 col-sm-12 ms-auto">
    <form action="#" method="post" autocomplete="off">
      <div class="input-group shadow-sm mb-3">
        <input type="text" class="form-control" placeholder="Pencarian.." name="keyword">
        <button class="btn btn-outline-secondary search" type="submit" name="submit"><i class="bi bi-search"></i>
          Cari</button>
      </div>
    </form>
  </div>

  <div class="row justify-content-between">
    <?php 1 + (6 * ($currentPage -1)); ?>
    <?php foreach ($galeri as $g) : ?>
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm h-100">
        <img src="<?= base_url('img/galeri'); ?>/<?= $g['gambar']; ?>" class="card-img-top p-2 gambar"
          alt="Gambar Galeri">
        <div class="card-body">
          <h5 class="card-title"><?= $g['judul']; ?></h5>
          <p class="card-text"><?= word_limiter($g['isi'], 20, '...'); ?></p>
          <a href="<?= base_url('galeri'); ?>/<?= $g['slug']; ?>" class="btn btn-danger stretched-link"> Baca
            selengkapnya</a>
        </div>
      </div>
    </div>
    <?php endForeach; ?>
  </div>
  <?= $pager->links('galeri', 'custom_pagination'); ?>
</div>

<?= $this->endSection(); ?>