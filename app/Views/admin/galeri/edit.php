<?= $this->extend('layout/templateAdmin'); ?>

<?= $this->section('content'); ?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="fw-bold">Form Ubah Data Galeri</h2>
        <hr>
        <a href="<?= base_url('galeriadmin'); ?>/<?= $galeri['slug']; ?>" class="text-reset"><i
            class='bx bx-arrow-to-left mb-4'></i>
          Kembali ke
          detail</a>
        <div class="col-12">
          <form action="<?= base_url('galeriadmin/update'); ?>/<?= $galeri['id_galeri']; ?>" method="POST"
            autocomplete="off" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= $galeri['slug']; ?>">
            <input type="hidden" name="gambarLama" value="<?= $galeri['gambar']; ?>">
            <div class="form-group row">
              <label for="judul" class="col-sm-2 col-form-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>"
                  id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $galeri['judul'] ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('judul'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('sumber')) ? 'is-invalid' : ''; ?>"
                  id="sumber" name="sumber" value="<?= (old('sumber')) ? old('sumber') : $galeri['sumber'] ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('sumber'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
              <div class="col-sm-2">
                <img src="<?= base_url('img/galeri'); ?>/<?= $galeri['gambar']; ?>" class="img-thumbnail img-preview">
              </div>
              <div class="col-sm-8">
                <div class="custom-file">
                  <input type="file"
                    class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar"
                    name="gambar" onchange="previewImg()">
                  <div class="invalid-feedback">
                    <?= $validation->getError('gambar'); ?>
                  </div>
                  <label class="custom-file-label" for="gambar"><?= $galeri['gambar']; ?></label>
                </div>
              </div>
            </div>
            <?php 
            $videoURL = str_replace("watch?v=", "embed/", $galeri['video']);
            ?>
            <div class="form-group row">
              <label for="video" class="col-sm-2 col-form-label">Video</label>
              <iframe class="col-sm-4" src="<?= $videoURL; ?>" allow="picture-in-picture" allowfullscreen></iframe>
              <div class="col-sm-6">
                <input type="url" class="form-control <?= ($validation->hasError('video')) ? 'is-invalid' : ''; ?>"
                  id="video" name="video" value="<?= (old('video')) ? old('video') : $galeri['video'] ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('video'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="isi" class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-sm-12">
                <textarea class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" id="isi"
                  name="isi"><?= (old('isi')) ? old('isi') : $galeri['isi'] ?></textarea>
              </div>
              <div class="invalid-feedback">
                <?= $validation->getError('isi'); ?>
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
</main>

<?= $this->endSection(); ?>