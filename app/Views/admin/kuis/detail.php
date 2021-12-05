<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container">
    <div class="row">
      <div class="col">
        <h3 class="fw-bold">Detail Soal</h3>
        <hr>

        <a href="<?= base_url('kuisadmin/edit'); ?>/<?= $soal['slug']; ?>" class="btn btn-warning me-2 edit mb-3"><i
            class="bi bi-pencil-square"></i> Edit</a>
        <form action="<?= base_url('kuisadmin/delete'); ?>/<?= $soal['id_quiz']; ?>" method="POST" class="d-inline">
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

        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="card shadow-sm">
              <ul class="list-group list-group-flush">
                <?php $pertanyaan = str_replace(['<p>', '</p>'], '', $soal['pertanyaan']); ?>
                <li class="list-group-item"><?= $pertanyaan ?></li>
                <li class="list-group-item">Pilihan 1 : <?= $soal['pilihan1']; ?></li>
                <li class="list-group-item">Pilihan 2 : <?= $soal['pilihan2']; ?></li>
                <li class="list-group-item">Pilihan 3 : <?= $soal['pilihan3']; ?></li>
                <li class="list-group-item">Jawaban : <?= $soal['jawaban']; ?></li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Dibuat : <?= Date("d-m-Y / H:i", strtotime($soal['created_at'])); ?> WIB
                    </div>
                    <div class="col-6">
                      Update :
                      <?= Date("d-m-Y / H:i", strtotime($soal['updated_at'])); ?> WIB
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>