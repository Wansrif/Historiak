<?php

namespace App\Controllers;

class KuisAdmin extends BaseController
{
  public function index()
  {
    $currentPage = $this->request->getVar('page_kuis') ? $this->request->getVar('page_kuis') : 1;

    $keyword = $this->request->getVar('keyword');
    if($keyword) {
      $kuis = $this->kuisModel->search($keyword);
    } else {
      $kuis = $this->kuisModel;
    }

    $data = [
      'title'       => 'Kuis',
      'kuis'        => $kuis->orderBy('id_quiz', 'DESC')->paginate(5, 'kuis'),
      'pager'       => $this->kuisModel->pager,
      'currentPage' => $currentPage,
    ];

    return view('admin/kuis/index', $data);
  }

  public function detail($slug)
  {
    $data = [
      'title' =>  'Detail Soal',
      'soal'  =>  $this->kuisModel->getKuis($slug)
    ];

    return view('admin/kuis/detail', $data);
  }
  
  public function create()
  {
    $data = [
      'title' =>  'Form Tambah Data Kuis',
      'validation'  =>  \Config\Services::validation(),
    ];

    return view('admin/kuis/create', $data);
  }

  public function save()
  {
    if (!$this->validate([
      'pertanyaan' => [
        'rules'   => 'required|is_unique[kuis.pertanyaan]',
        'errors'  => [
          'required' => 'Masukkan soal terlebih dahulu.',
          'is_unique' => 'Soal yang anda masukan sudah terdaftar.'
        ]
      ],
      'pilihan1' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 1 terlebih dahulu.'
        ]
      ],
      'pilihan2' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 2 terlebih dahulu.'
        ]
      ],
      'pilihan3' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 3 terlebih dahulu.'
        ]
      ],
      'jawaban' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan jawaban terlebih dahulu.'
        ]
      ],
    ])) {
      return redirect()->to('/kuisadmin/create')->withInput();
    }

    $slug = url_title($this->request->getVar('pertanyaan'), '-', true);
    $this->kuisModel->save([
      'pertanyaan' => $this->request->getVar('pertanyaan'),
      'slug'      => $slug,
      'pilihan1' => $this->request->getVar('pilihan1'),
      'pilihan2' => $this->request->getVar('pilihan2'),
      'pilihan3' => $this->request->getVar('pilihan3'),
      'jawaban' => $this->request->getVar('jawaban'),
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/kuisadmin');
  }

  // DELETE SOAL
  public function delete($id_quiz)
  {
    $this->kuisModel->delete($id_quiz);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/kuisadmin');
  }
  
  // EDIT
  public function edit($slug)
  {
    $data = [
      'title' =>  'Form Ubah Data Soal',
      'validation'  =>  \Config\Services::validation(),
      'soal'      => $this->kuisModel->getKuis($slug),
    ];

    return view('admin/kuis/edit', $data);
  }

  // UPDATE SOAL
  public function update($id_quiz)
  {
    $kuisLama = $this->kuisModel->getKuis($this->request->getVar('slug'));
    if($kuisLama['pertanyaan'] == $this->request->getVar('pertanyaan')) {
      $rule_pertanyaan = 'required';
    } else {
      $rule_pertanyaan = 'required|is_unique[kuis.pertanyaan]';
    }

    // Validasi input
    if (!$this->validate([
      'pertanyaan' => [
        'rules'   => $rule_pertanyaan,
        'errors'  => [
          'required' => 'Masukkan soal terlebih dahulu.',
          'is_unique' => 'Soal yang anda masukan sudah terdaftar.'
        ]
      ],
      'pilihan1' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 1 terlebih dahulu.'
        ]
      ],
      'pilihan2' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 2 terlebih dahulu.'
        ]
      ],
      'pilihan3' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan pilihan 3 terlebih dahulu.'
        ]
      ],
      'jawaban' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan jawaban terlebih dahulu.'
        ]
      ],
    ])) {
      return redirect()->to('/kuisadmin/edit/' . $this->request->getVar('slug'))->withInput();
    }

    $slug = url_title($this->request->getVar('pertanyaan'), '-', true);
    $this->kuisModel->save([
      'id_quiz'    => $id_quiz,
      'pertanyaan' => $this->request->getVar('pertanyaan'),
      'slug'      => $slug,
      'pilihan1' => $this->request->getVar('pilihan1'),
      'pilihan2' => $this->request->getVar('pilihan2'),
      'pilihan3' => $this->request->getVar('pilihan3'),
      'jawaban' => $this->request->getVar('jawaban'),
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');
    return redirect()->to('/kuisadmin');
  }
}