<?php

namespace App\Controllers;


class KerajaanAdmin extends BaseController
{
	public function index()
	{

    $currentPage = $this->request->getVar('page_kerajaan') ? $this->request->getVar('page_kerajaan') : 1;

    $keyword = $this->request->getVar('keyword');
    if($keyword) {
      $kerajaan = $this->kerajaanModel->search($keyword);
    } else {
      $kerajaan = $this->kerajaanModel;
    }

    $data = [
      'title'       => 'Kerajaan',
      'kerajaan'    => $kerajaan->orderBy('id_kerajaan', 'DESC')->paginate(5, 'kerajaan'),
      'pager'       => $this->kerajaanModel->pager,
      'currentPage' => $currentPage,
    ];
		return view('admin/kerajaan/index', $data);
	}


  // DETAIL
  public function detail($slug)
  {
    $data = [
      'title'  => 'Detail Kerajaan',
      'kerajaan' => $this->kerajaanModel->getKerajaan($slug)
    ];

  //  jika kerajaan tidak ada di tabel
  if (empty($data['kerajaan'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul kerajaan ' . $slug . ' tidak ditemukan.');
  }

  return view('admin/kerajaan/detail', $data);
  }


  // TAMBAH DATA
  public function create()
  {
    $data = [
      'title' =>  'Form Tambah Data Kerajaan',
      'validation'  =>  \Config\Services::validation(),
      'notifpesan'  => $this->pesanModel->jmlPesan()
    ];

    return view('admin/kerajaan/create', $data);
  }


  // SAVE DATA
  public function save()
  {
    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules'   => 'required|is_unique[kerajaan.judul]',
        'errors'  => [
          'required'  =>  'Masukkan judul terlebih dahulu.',
          'is_unique' =>  'Judul kerajaan sudah terdaftar.'
        ] 
        ],
      'sumber' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan sumber terlebih dahulu.'
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
          'rules'   =>  'required',
          'errors'  =>  [
            'required' => 'Masukkan keterangan terlebih dahulu.'
        ]
        ]
    ])) {
      return redirect()->to('/kerajaanadmin/create')->withInput();
    }

    // ambil gambar
    $fileGambar = $this->request->getFile('gambar');
    // apakah tidak ada gambar yg diupload
    if($fileGambar->getError() == 4) {
      $namaGambar = 'defaultKerajaan.jpg';
    } else {
      // generate nama random gambar
    $namaGambar = $fileGambar->getRandomName();
    // pindahkan file ke folder kerajaan
    $fileGambar->move('img/kerajaan', $namaGambar);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->kerajaanModel->save([
      'judul' =>  $this->request->getVar('judul'),
      'slug'  =>  $slug,
      'sumber' =>  $this->request->getVar('sumber'),
      'gambar' =>  $namaGambar,
      'video'  =>  $this->request->getPost('video'),
      'isi' =>  $this->request->getVar('isi')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/kerajaanadmin');
  }


  // HAPUS DATA
  public function delete($id_kerajaan)
  {
    // cari gambar berdasarkan id
    $kerajaan = $this->kerajaanModel->find($id_kerajaan);

    // cek jika file gambarnya default
    if($kerajaan['gambar'] != 'defaultKerajaan.jpg') {
    // hapus gambar
    unlink('img/kerajaan/' . $kerajaan['gambar']);
    }

    $this->kerajaanModel->delete($id_kerajaan);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/kerajaanadmin');
  }

  // EDIT
  public function edit($slug)
  {
    $data = [
      'title' =>  'Form Ubah Data Kerajaan',
      'validation'  =>  \Config\Services::validation(),
      'kerajaan'      => $this->kerajaanModel->getKerajaan($slug),
    ];

    return view('admin/kerajaan/edit', $data);
  }


  // UPDATE DATA
  public function update($id_kerajaan)
  {
    // Cek Judul
    $kerajaanLama = $this->kerajaanModel->getKerajaan($this->request->getVar('slug'));
    if($kerajaanLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = 'required';
    } else {
      $rule_judul = 'required|is_unique[kerajaan.judul]';
    }

    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules'   => $rule_judul,
        'errors'  => [
          'required'  =>  'Masukkan judul terlebih dahulu.',
          'is_unique' =>  'Judul kerajaan sudah terdaftar'
        ] 
        ],
      'sumber' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required' => 'Masukkan sumber terlebih dahulu.'
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
          'rules'   =>  'required',
          'errors'  =>  [
            'required' => 'Masukkan keterangan terlebih dahulu.',
        ]
        ],
    ])) {
      return redirect()->to('/kerajaanadmin/edit/' . $this->request->getVar('slug'))->withInput();
    }

    $fileGambar = $this->request->getFile('gambar');

    // cek gambar berubah atau tetap gambar lama
    if($fileGambar->getError() == 4) {
      $namaGambar = $this->request->getVar('gambarLama');
    } else {
      // generate nama gambar random
      $namaGambar = $fileGambar->getRandomName();
      $fileGambar->move('img/kerajaan', $namaGambar);
      // hapus file lama
      ($namaGambar) ? 'defaultKerajaan.jpg' : unlink('img/kerajaan/' . $this->request->getVar('gambarLama'));
    }


    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->kerajaanModel->save([
      'id_kerajaan' =>  $id_kerajaan,
      'judul'       =>  $this->request->getVar('judul'),
      'slug'        =>  $slug,
      'sumber'      =>  $this->request->getVar('sumber'),
      'gambar'      =>  $namaGambar,
      'video'       =>  $this->request->getVar('video'),
      'isi'         =>  $this->request->getVar('isi')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');

    return redirect()->to('/kerajaanadmin');
  }
}