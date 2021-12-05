<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="max-width: 85%;">
  <div class="row">
    <div class="col">
      <h1 class="my-4 text-center judul">Tokoh Kerajaan</h1>
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

  <div class="row">
    <?php 1 + (6 * ($currentPage -1)); ?>
    <?php foreach($tokoh as $t) : ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="<?= base_url('img/tokoh'); ?>/<?= $t['gambar']; ?>" class="card-img-top thumbnail p-2"
          alt="Gambar Tokoh">
        <div class="card-body">
          <h5 class="card-title"><?= $t['judul']; ?></h5>
          <p class="card-text"><?= word_limiter($t['isi'], 15, '...'); ?></p>
          <a href="<?= base_url('tokohkerajaan'); ?>/<?= $t['slug']; ?>" class="btn btn-danger stretched-link"> Baca
            selengkapnya</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?= $pager->links('tokoh', 'custom_pagination'); ?>
</div>
<?= $this->endSection(); ?>