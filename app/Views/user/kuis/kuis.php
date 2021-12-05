<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center mt-5 judul">Kuis Sejarah Kerajaan Hindu Budha</h1>

      <div class="row justify-content-center my-3">
        <div class="col-sm-12 col-md-10">
          <div class="card shadow-sm mb-3">
            <!-- Timer -->
            <div class="card-header">
              <div class="fw-bold float-end">
                Timer : <span id="timer">00:00</span>
              </div>
            </div>

            <div class="card-body">

              <form action="<?= base_url('kuis/hasil'); ?>" method="POST" id="quest">
                <?= csrf_field(); ?>

                <?php $i = 1; ?>
                <?php foreach($soal as $s) : ?>
                <?php $jwb_array = [
                  $s['pilihan1'], $s['pilihan2'], $s['pilihan3'], $s['jawaban']
                ]; if(empty($_SESSION['jwb_array'.$i])){
                  shuffle($jwb_array);
                  $_SESSION['jwb_array'.$i] = $jwb_array;
                } else {
                  $jwb_array = $_SESSION['jwb_array'.$i];
                }?>
                <?php $pertanyaan = str_replace(['<p>', '</p>'], '', $s['pertanyaan']); ?>

                <div class="soal mb-3">
                  <p><?= $i++; ?>. <?= $pertanyaan ?></p>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="quest<?= $s['id_quiz']; ?>"
                      value="<?= $jwb_array[0] ?>" id="<?= $jwb_array[0] . $s['id_quiz']; ?>">
                    <label class="form-check-label" for="<?= $jwb_array[0] . $s['id_quiz']; ?>">
                      <?= $jwb_array[0] ?>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="quest<?= $s['id_quiz']; ?>"
                      value="<?= $jwb_array[1] ?>" id="<?= $jwb_array[1] . $s['id_quiz']; ?>">
                    <label class="form-check-label" for="<?= $jwb_array[1] . $s['id_quiz']; ?>">
                      <?= $jwb_array[1] ?>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="quest<?= $s['id_quiz']; ?>"
                      value="<?= $jwb_array[2] ?>" id="<?= $jwb_array[2] . $s['id_quiz']; ?>">
                    <label class="form-check-label" for="<?= $jwb_array[2] . $s['id_quiz']; ?>">
                      <?= $jwb_array[2] ?>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="quest<?= $s['id_quiz']; ?>"
                      value="<?= $jwb_array[3] ?>" id="<?= $jwb_array[3] . $s['id_quiz']; ?>">
                    <label class="form-check-label" for="<?= $jwb_array[3] . $s['id_quiz']; ?>">
                      <?= $jwb_array[3] ?>
                    </label>
                  </div>
                </div>
                <?php endforeach; ?>

                <div class="form-group row">
                  <div class="col">

                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2">
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Submit
                      </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                      tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Submit Jawaban</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Apakah anda sudah yakin?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button onclick="deleteSession()" type="submit" class="btn btn-primary" name="unsetKuis"
                              value="4">Submit</button>
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
  </div>
</div>

<script src="<?= base_url('js/timer.js'); ?>"></script>
<?= $this->endSection() ;?>