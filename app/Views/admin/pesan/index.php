<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md">
        <h3 class="fw-bold">Administrator <i class="bi bi-chevron-double-right"></i> <?= $title; ?></h3>
        <hr>

        <div class="row">
          <div class="col-md-6 ms-auto">
            <form action="#" method="post" autocomplete="off">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan nama pengirim.." name="keyword">
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
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 + (5 * ($currentPage -1)); ?>
              <?php foreach($pesan as $p) : ?>
              <tr>
                <th class="nomor" scope="row"><?= $i++; ?></th>
                <td><?= $p['nama']; ?></td>
                <td><?= Date("d-m-Y H:i", strtotime($p['created_at'])); ?> WIB</td>
                <td>
                  <a href="/pesan/<?= $p['slug']; ?>" class="btn detail">Detail</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?= $pager->links('pesan', 'custom_pagination'); ?>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>