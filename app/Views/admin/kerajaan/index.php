<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md">
        <h3 class="fw-bold judul">Administrator <i class="bi bi-chevron-double-right"></i> <?= $title; ?></h3>
        <hr>

        <div class="row justify-content-between">
          <div class="col-md-4">
            <a href="<?= base_url('kerajaanadmin/create'); ?>" class="btn text-white tambah mb-3"><i
                class="bi bi-plus-lg me-2"></i>Tambah
              Data</a>
          </div>
          <div class="col-md-6">
            <form method="post" autocomplete="off">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pencarian.." name="keyword">
                <button class="btn btn-outline-secondary search" type="submit" name="submit"><i
                    class="bi bi-search"></i>
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
                <th scope="col">Judul</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 + (5 * ($currentPage -1)); ?>
              <?php foreach($kerajaan as $k) : ?>
              <tr>
                <th class="nomor" scope="row"><?= $i++; ?></th>
                <td><?= $k['judul']; ?></td>
                <td><?= Date("d-m-Y H:i", strtotime($k['created_at'])); ?> WIB</td>
                <td>
                  <a href="/kerajaanadmin/<?= $k['slug']; ?>" class="btn detail">Detail</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?= $pager->links('kerajaan', 'custom_pagination'); ?>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>