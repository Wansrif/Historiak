<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h3 class="fw-bold judul">Administrator <i class="bi bi-chevron-double-right"></i> <?= $title; ?></h3>
        <hr>

        <div class="row">
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-card h-100">
              <div class="card-body text-white fw-bold">
                <h5 class=" fw-bold">Kerajaan</h5>
                <p><?= $kerajaan; ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-card h-100">
              <div class="card-body text-white fw-bold">
                <h5 class="fw-bold">Tokoh Kerajaan</h5>
                <p><?= $tokoh; ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-card h-100">
              <div class="card-body text-white fw-bold">
                <h5 class="fw-bold">Galeri</h5>
                <p><?= $galeri; ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-card h-100">
              <div class="card-body text-white fw-bold">
                <h5 class="fw-bold">Pesan</h5>
                <p><?= $pesan; ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-card h-100">
              <div class="card-body text-white fw-bold">
                <h5 class="fw-bold">Kuis</h5>
                <p><?= $kuis; ?></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>