<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="fw-bold">Detail Pesan</h2>
        <hr>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card pesan">
              <div class="card-body">
                <h5 class="card-title"><?= $pesan['nama']; ?></h5>
                <h6 class="card-subtitle mb-2"><?= $pesan['email']; ?></h6>
                <p class="card-text font-italic">"<?= $pesan['isi_pesan']; ?>"</p>
                <span class="card-text"><small class="text-muted">Dikirim :
                    <?= Date("d-m-Y H:i", strtotime($pesan['created_at'])); ?> WIB</small>
                </span>
                <form action="<?= base_url('pesan'); ?>/<?= $pesan['id_pesan']; ?>" method="POST" class="d-inline">
                  <?= csrf_field(); ?>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger float-right hapus" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"><i class="bi bi-trash-fill"></i> Delete</button>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                          <button type="submit" class="btn btn-danger hapus"><i class="bi bi-trash-fill"></i>
                            Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>