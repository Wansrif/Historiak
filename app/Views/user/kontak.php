<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">

      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 my-5 darkmode-ignore">
          <div class="card bradius">
            <div class="card-body kontak">
              <h1 class="mb-4">informasi kontak</h1>

              <?php if(session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-light text-center" role="alert">
                <div>
                  <i class='bx-fw bx bxl-telegram'></i> <?= session()->getFlashdata('pesan'); ?>
                </div>
              </div>
              <?php endif; ?>

              <div class="row">
                <div class="col-md-6">
                  <p>Silahkan hubungi untuk pertanyaanmu</p>
                  <h3>NO. TELEPON</h3>
                  <P><i class="bi bi-whatsapp"></i> 082112345678</P>
                  <h3>EMAIL</h3>
                  <P><i class="bi bi-envelope"></i> admin@historiak.com</P>
                  <h3>ALAMAT</h3>
                  <P><i class="bi bi-geo-alt-fill"></i> Lubang buaya Kec. Cipayung Kota Jakarta Timur
                  </P>
                </div>

                <div class="col-md-6">
                  <form action="<?= base_url('kontak/kirim'); ?>" method="POST" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text"
                        class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama"
                        name="nama" value="<?= old('nama'); ?>">
                      <div class="invalid-feedback text-white">
                        <?= $validation->getError('nama'); ?>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="text"
                        class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email"
                        name="email" value="<?= old('email'); ?>">
                      <div class="invalid-feedback text-white">
                        <?= $validation->getError('email'); ?>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="isi_pesan" class="form-label">Pesan</label>
                      <textarea class="form-control <?= ($validation->hasError('isi_pesan')) ? 'is-invalid' : ''; ?>"
                        id="isi_pesan" rows="3" placeholder="Ketik pesanmu disini.."
                        name="isi_pesan"><?= old('isi_pesan'); ?></textarea>
                      <div class="invalid-feedback text-white">
                        <?= $validation->getError('isi_pesan'); ?>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-light float-end"><i class='bx-fw bx bxl-telegram'></i>
                      Kirim</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection(); ?>