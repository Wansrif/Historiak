<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="fw-bold">Detail Gambar</h2>
        <hr>
        <a href="<?= base_url('galeriadmin/edit'); ?>/<?= $galeri['slug']; ?>" class="btn btn-warning me-2 edit mb-3"><i
            class="bi bi-pencil-square"></i> Edit</a>
        <form action="<?= base_url('galeriadmin'); ?>/<?= $galeri['id_galeri']; ?>" method="POST" class="d-inline">
          <?= csrf_field(); ?>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger mb-3 hapus" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"><i class="bi bi-trash-fill"></i> Delete</button>
          </button>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Hapus Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah anda sudah yakin?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger hapus"><i class="bi bi-trash-fill"></i> Delete</button>
                </div>
              </div>
            </div>
          </div>

        </form>

        <div class="row justify-content-center">
          <div class="col-10">
            <div class="card shadow mb-4">
              <img src="<?= base_url('img/galeri'); ?>/<?= $galeri['gambar']; ?>" class="card-img-top gambarGaleri p-2"
                alt="Gambar Galeri">
              <div class="card-body">
                <h5 class="card-title"><?= $galeri['judul']; ?></h5>
                <?php 
                $videoURL = str_replace("watch?v=", "embed/", $galeri['video']);
                ?>
                <iframe class="card-text" src="<?= $videoURL; ?>" allow="picture-in-picture" allowfullscreen></iframe>
                <p class="card-text"><?= $galeri['isi']; ?></p>
                <p class="card-text"><small class="text-muted">Sumber : <b><?= $galeri['sumber']; ?></small></b></p>
                <p class="card-text"><small class="text-muted">Dibuat :
                    <?= Date("d-m-Y H:i", strtotime($galeri['created_at'])); ?> WIB || Terakhir diupdate :
                    <?= Date("d-m-Y H:i", strtotime($galeri['updated_at'])); ?> WIB</small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>