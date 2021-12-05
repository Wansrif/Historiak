<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md">
        <h3 class="fw-bold">Administrator <i class="bi bi-chevron-double-right"></i> <?= $title; ?></h3>
        <hr>
        <div class="row justify-content-between">
          <div class="col-md-4">
            <a href="<?= base_url('galeriadmin/create'); ?>" class="btn text-white mb-3 tambah" disabled><i
                class="bi bi-plus-lg me-2"></i>Tambah Data</a>
          </div>
          <div class="col-md-6">
            <form action="#" method="post" autocomplete="off">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pencarian.." name="keyword">
                <button class="btn btn-outline-secondary" type="submit" name="submit"><i class="bi bi-search"></i>
                  Cari</button>
              </div>
            </form>
          </div>
        </div>
        <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <i class="bi bi-check2-all me-2"></i>
          <div>
            <?= session()->getFlashdata('pesan'); ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 + (5 * ($currentPage -1)) ?>
              <?php foreach ($galeri as $g) : ?>
              <tr>
                <th class="nomor" scope="row"><?= $i++; ?></th>
                <td><img src="/img/galeri/<?= $g['gambar']; ?>" alt="" class="gambar"></td>
                <td><?= $g['judul']; ?></td>
                <td>
                  <a href="/galeriadmin/<?= $g['slug']; ?>" class="btn detail">Detail</a>
                </td>
              </tr>
              <?php endForeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('galeri', 'custom_pagination'); ?>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>