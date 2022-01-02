<?php

namespace App\Controllers;

class GaleriAdmin extends BaseController
{
  public function index()
	{

    $currentPage = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;

    $keyword = $this->request->getVar('keyword');
    if($keyword) {
      $galeri = $this->galeriModel->search($keyword);
    } else {
      $galeri = $this->galeriModel;
    }
    
    $data = [
      'title'       => 'Galeri',
      'galeri'      => $galeri->orderBy('created_at', 'DESC')
      ->paginate(5, 'galeri'),
      'pager'       => $this->galeriModel->pager,
      'currentPage' => $currentPage,
    ];

		return view('admin/galeri/index', $data);
	}

  // DETAIL
  public function detail($slug)
  {
    $data = [
      'title'  => 'Detail Gambar',
      'galeri' => $this->galeriModel->getGaleri($slug),
    ];

  //  jika galeri tidak ada di tabel
  if (empty($data['galeri'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul galeri ' . $slug . ' tidak ditemukan.');
  }

    return view('admin/galeri/detail', $data);
  }

  // TAMBAH DATA
  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Galeri',
      'validation' => \Config\Services::validation(),
    ];

    return view('admin/galeri/create', $data);
  }

  // SAVE DATA
  public function save()
  {
$fileGambar = $this->request->getFile('gambar');
    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules' => 'required|is_unique[galeri.judul]',
        'errors' => [
          'required' => 'Masukkan {field} terlebih dahulu.',
          'is_unique' => 'Judul galeri sudah terdaftar.'
        ]
      ],
      'sumber' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Masukkan {field} terlebih dahulu.'
        ]
      ],
      'gambar' => [
        'rules' => 'max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        'errors'  => [
          'max_size'  => 'Ukuran gambar tidak boleh lebih dari 2MB',
          'mime_in'   => 'Gambar harus berformat .jpg/.jpeg/.png'
        ]
      ],
      'video' => [
        'rules'   =>  'required|valid_url',
        'errors'  =>  [
          'required' => 'Masukkan url {field} terlebih dahulu.'
      ]
      ],
      'isi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Masukkan keterangan terlebih dahulu.'
        ]
      ]
    ])) {
      return redirect()->to('/galeriadmin/create')->withInput();
    }

    // ambil gambar
    $fileGambar = $this->request->getFile('gambar');
    // apakah tidak ada gambar yang diupload
    if($fileGambar->getError() == 4) {
      $namaGambar = 'defaultGaleri.jpg';
    } else {
      // generate nama gambar random
      $namaGambar = $fileGambar->getRandomName();
      // pindahkan file ke folder img
      $fileGambar->move('img/galeri', $namaGambar);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->galeriModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug'  => $slug,
      'sumber' => $this->request->getVar('sumber'),
      'isi' => $this->request->getVar('isi'),
      'gambar' => $namaGambar,
      'video'  =>  $this->request->getVar('video'),
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/galeriadmin');
  }


  // HAPUS DATA
  public function delete($id_galeri)
  {
    // cari gambar berdasarkan id
    $galeri = $this->galeriModel->find($id_galeri);

    // cek jika file gambarnya default
    if($galeri['gambar'] != 'defaultGaleri.jpg') {
      // hapus gambar
      unlink('img/galeri/' . $galeri['gambar']);
    }

    $this->galeriModel->delete($id_galeri);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/galeriadmin');
  }

  // EDIT
  public function edit($slug)
  {
    $data = [
      'title' => 'Form Ubah Data Galeri',
      'validation' => \Config\Services::validation(),
      'galeri'  =>  $this->galeriModel->getGaleri($slug),
    ];

    return view('admin/galeri/edit', $data);
  }

  // UPDATE DATA
  public function update($id_galeri)
  {
    // cek judul
    $galeriLama = $this->galeriModel->getGaleri($this->request->getVar('slug'));
    if ($galeriLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = 'required';
    } else {
      $rule_judul = 'required|is_unique[galeri.judul]';
    }

    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules' => $rule_judul,
        'errors' => [
          'required' => 'Masukkan {field} terlebih dahulu.',
          'is_unique' => '{field} galeri sudah terdaftar.'
        ]
      ],
      'sumber' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Masukkan {field} terlebih dahulu.'
        ]
      ],
      'gambar' => [
        'rules' => 'max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        'errors'  => [
          'max_size'  => 'Ukuran gambar tidak boleh lebih dari 2MB',
          'mime_in'   => 'Gambar harus berformat .jpg/.jpeg/.png'
        ]
      ],
      'video' => [
        'rules'   =>  'required|valid_url',
        'errors'  =>  [
          'required' => 'Masukkan url {field} terlebih dahulu.'
      ]
      ],
      'isi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Masukkan keterangan terlebih dahulu.'
        ]
      ]
    ])) {
      return redirect()->to('/galeriadmin/edit/' . $this->request->getVar('slug'))->withInput();
    }

    $fileGambar = $this->request->getFile('gambar');

    // cek gambar, apakah tetap gambar lama
    if($fileGambar->getError() == 4) {
      $namaGambar = $this->request->getVar('gambarLama');
    } else {
      // generate nama file random
      $namaGambar = $fileGambar->getRandomName();
      // pindahkan gambar
      $fileGambar->move('img/galeri', $namaGambar);
      // hapus file yang lama
      unlink('img/galeri/' . $this->request->getVar('gambarLama'));
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->galeriModel->save([
      'id_galeri'    => $id_galeri,
      'judul' => $this->request->getVar('judul'),
      'slug'  => $slug,
      'sumber' => $this->request->getVar('sumber'),
      'isi' => $this->request->getVar('isi'),
      'gambar' => $namaGambar,
      'video'  =>  $this->request->getVar('video'),
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');

    return redirect()->to('/galeriadmin');
  }
}