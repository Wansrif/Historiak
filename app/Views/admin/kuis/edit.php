<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container">
    <div class="row">
      <div class="col">
        <h3 class="fw-bold"><?= $title; ?></h3>
        <hr>
        <a href="<?= base_url('kuisadmin'); ?>/<?= $soal['slug']; ?>" class="text-reset"><i
            class='bx bx-arrow-to-left mb-3'></i>
          Kembali ke detail</a>
        <div class="row">
          <div class="col">
            <form action="<?= base_url('kuisadmin/update'); ?>/<?= $soal['id_quiz']; ?>" method="post"
              autocomplete="off">
              <?= csrf_field(); ?>

              <input type="hidden" name="slug" value="<?= $soal['slug']; ?>">
              <div class="form-group row">
                <label for="pertanyaan" class="col-sm-2">Soal</label>
                <div class="col-sm-10">
                  <textarea class="form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : ''; ?>"
                    id="isi"
                    name="pertanyaan"><?= (old('pertanyaan')) ? old('pertanyaan') : $soal['pertanyaan']; ?></textarea>
                  <div class="invalid-feedback">
                    <?= $validation->getError('pertanyaan'); ?>
                  </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="pilihan1" class="col-sm-2 col-form-label">Pilihan 1</label>
                <div class="col-sm-10">
                  <input type="text"
                    class="form-control <?= ($validation->hasError('pilihan1')) ? 'is-invalid' : ''; ?>" id="pilihan1"
                    name="pilihan1" value="<?= (old('pilihan1')) ? old('pilihan1') : $soal['pilihan1']; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('pilihan1'); ?>
                  </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="pilihan2" class="col-sm-2 col-form-label">Pilihan 2</label>
                <div class="col-sm-10">
                  <input type="text"
                    class="form-control <?= ($validation->hasError('pilihan2')) ? 'is-invalid' : ''; ?>" id="pilihan2"
                    name="pilihan2" value="<?= (old('pilihan2')) ? old('pilihan2') : $soal['pilihan2']; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('pilihan2'); ?>
                  </div>
                </div>
              </div>
              <div class=" mb-3 row">
                <label for="pilihan3" class="col-sm-2 col-form-label">Pilihan 3</label>
                <div class="col-sm-10">
                  <input type="text"
                    class="form-control <?= ($validation->hasError('pilihan2')) ? 'is-invalid' : ''; ?>" id="pilihan3"
                    name="pilihan3" value="<?= (old('pilihan3')) ? old('pilihan3') : $soal['pilihan3']; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('pilihan3'); ?>
                  </div>
                </div>
              </div>
              <div class=" mb-3 row">
                <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('jawaban')) ? 'is-invalid' : ''; ?>"
                    id="jawaban" name="jawaban" value="<?= (old('jawaban')) ? old('jawaban') : $soal['jawaban']; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('jawaban'); ?>
                  </div>
                </div>
              </div>

              <div class=" form-group row">
                <div class="col">

                  <!-- Button trigger modal -->
                  <div class="d-grid gap-2">
                    <button type="button" class="btn text-white tambah" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop"><i class='bx-fw bx bx-save'></i>Simpan
                    </button>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Ubah Data</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah anda sudah yakin?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn text-white tambah"><i
                              class='bx-fw bx bx-save'></i>Simpan</button>
                        </div>
                      </div>
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
</main>

<?= $this->endSection(); ?>