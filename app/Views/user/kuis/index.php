<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">

  <div class="row">
    <div class="col">
      <h1 class="text-center mt-5 text-black judul">Kuis Sejarah Kerajaan Hindu Budha</h1>
    </div>
  </div>

  <div class="row my-4">
    <div class="col text-center darkmode-ignore">
      <form action="<?= base_url('kuis/soalkuis'); ?>" method="post">
        <button type="submit" class="btn btn-primary text-uppercase fw-bold shadow" onclick="deleteSession()">
          <i class='bx-fw bx bx-play bx-flashing'></i><i class='bx-fw bx bx-play bx-flashing'></i>Mulai Kuis<i
            class='bx-fw bx bx-play bx-flip-horizontal bx-flashing'></i><i
            class='bx-fw bx bx-play bx-flip-horizontal bx-flashing'></i>
        </button>
      </form>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
      <div class="card shadow">
        <div class="card-body">
          <h5>Sebelum memulai kuis bacalah peraturan kuis dibawah ini!</h5>
          <hr>
          <p>1. Waktu pengerjaan kuis hanya 20 menit.</p>
          <p>2. Jika dalam waktu 20 menit belum selesai maka kuis otomatis akan selesai.</p>
          <p>3. Kuis bertipe pilihan ganda dan hanya bisa memilih 1 jawaban.</p>
          <p>4. Terdapat 20 pertanyaan di dalam kuis.</p>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="<?= base_url('js/deleteSession.js'); ?>"></script>
<?= $this->endSection() ;?>