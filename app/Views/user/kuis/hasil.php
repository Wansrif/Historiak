<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center mt-5 judul">Kuis Sejarah Kerajaan Hindu Budha</h1>
    </div>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-sm-12 col-md-10">

      <div class="card shadow-sm mb-3">
        <div class="card-body">

          <form action="<?= base_url('kuis'); ?>" method="POST">
            <?php $i  =  1; ?>
            <?php foreach($hasil as $h) : ?>

            <div class="soal mb-3">
              <?php $pertanyaan = str_replace(['<p>', '</p>'], '', $h['pertanyaan']); ?>

              <p><?= $i++; ?>. <?= $pertanyaan; ?></p>

              <?php if ($h['terpilih'] != $h['jawaban']) : ?>

              <div class="form-check"
                style="<?= ($h['terpilih']) ? 'background-color: #f8d7da' : 'background-color: #f8d7da'; ?>">
                <input class="form-check-input" type="radio" name="quest<?= $h['id_quiz'] ?>"
                  id="flexRadioCheckedDisabled" disabled <?= ($h['terpilih']) ? 'checked' : '' ?>>
                <label class="form-check-label fw-bolder text-body" for="flexRadioCheckedDisabled">
                  <?= $h['terpilih'] ?>
                </label>
              </div>

              <div class="form-check" style="background-color: aquamarine;">
                <input class="form-check-input" type="radio" name="quest<?= $h['id_quiz'] ?>"
                  id="flexRadioCheckedDisabled" disabled <?= ($h['jawaban']) ? '' : 'checked' ?>>
                <label class="form-check-label fw-bolder text-body" for="flexRadioCheckedDisabled">
                  <?= $h['jawaban'] ?>
                </label>
              </div>

              <?php else : ?>

              <div class="form-check" style="background-color: aquamarine;">
                <input class="form-check-input" type="radio" name="quest<?= $h['id_quiz'] ?>"
                  id="flexRadioCheckedDisabled" disabled <?= ($h['terpilih']) ? 'checked' : '' ?>>
                <label class="form-check-label fw-bolder text-body" for="flexRadioCheckedDisabled">
                  <?= $h['jawaban'] ?>
                </label>
              </div>

              <?php endif ?>

            </div>
            <?php endforeach; ?>

            <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <i class="bi bi-check2-all me-2"></i>
              <div>
                <?= session()->getFlashdata('pesan'); ?>
              </div>
            </div>
            <?php endif; ?>

            <h2>Nilai anda: <?=  $score ?>/<?= $soal; ?></h2>

            <div class="form-group row">
              <div class="d-grid gap-2">
                <button class="btn btn-primary shadow" type="submit">Main lagi!</button>
              </div>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>

</div>
<?= $this->endSection() ;?>