<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10">
          <div class="card shadow my-5">
            <img src="<?= base_url('img/kerajaan'); ?>/<?= $kerajaan['gambar']; ?>" class="card-img-top p-2">
            <div class="card-body">
              <h5 class="card-title"><?= $kerajaan['judul']; ?></h5>
              <?php 
              $videoURL = str_replace("watch?v=", "embed/", $kerajaan['video']);
              ?>
              <iframe class="card-text" src="<?= $videoURL; ?>" allow="picture-in-picture" allowfullscreen></iframe>
              <p class="card-text"><?= $kerajaan['isi']; ?></p>
              <p class="card-text"><small class="muted">Sumber : <b><?= $kerajaan['sumber']; ?></small></b></p>
              <span class="card-text"><small
                  class="muted"><?= Date("d-m-Y / H:i", strtotime($kerajaan['created_at'])); ?> WIB</small>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>