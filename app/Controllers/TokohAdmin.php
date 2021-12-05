<?php

namespace App\Controllers;


class TokohAdmin extends BaseController
{
	public function index()
	{

    $currentPage = $this->request->getVar('page_tokoh') ? $this->request->getVar('page_tokoh') : 1;

    $keyword = $this->request->getVar('keyword');
    if($keyword) {
      $tokoh = $this->tokohModel->search($keyword);
    } else {
      $tokoh = $this->tokohModel;
    }

    $data = [
      'title'       => 'Tokoh Kerajaan',
      'tokoh'       => $tokoh->orderBy('id_tokoh', 'DESC')->paginate(5, 'tokoh'),
      'pager'       => $this->tokohModel->pager,
      'currentPage' => $currentPage,
    ];
		return view('admin/tokoh/index', $data);
	}


  // DETAIL
  public function detail($slug)
  {
    $data = [
      'title'  => 'Detail Tokoh',
      'tokoh' => $this->tokohModel->getTokoh($slug),
      'notifpesan'  => $this->pesanModel->jmlPesan()
    ];

  //  jika tokoh tidak ada di tabel
  if (empty($data['tokoh'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul tokoh ' . $slug . ' tidak ditemukan.');
  }

  return view('admin/tokoh/detail', $data);
  }


  // TAMBAH DATA
  public function create()
  {
    $data = [
      'title' =>  'Form Tambah Data Tokoh Kerajaan',
      'validation'  =>  \Config\Services::validation(),
    ];

    return view('admin/tokoh/create', $data);
  }


  // SAVE DATA
  public function save()
  {
    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules'   => 'required|is_unique[tokoh.judul]',
        'errors'  => [
          'required'  =>  'Masukkan judul terlebih dahulu.',
          'is_unique' =>  'Judul tokoh sudah terdaftar.'
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
      return redirect()->to('/tokohadmin/create')->withInput();
    }

    // ambil gambar
    $fileGambar = $this->request->getFile('gambar');
    // apakah tidak ada gambar yg diupload
    if($fileGambar->getError() == 4) {
      $namaGambar = 'defaultTokoh.jpeg';
    } else {
      // generate nama random gambar
    $namaGambar = $fileGambar->getRandomName();
    // pindahkan file ke folder tokoh
    $fileGambar->move('img/tokoh', $namaGambar);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->tokohModel->save([
      'judul' =>  $this->request->getVar('judul'),
      'slug'  =>  $slug,
      'sumber' =>  $this->request->getVar('sumber'),
      'gambar' =>  $namaGambar,
      'video' =>  $this->request->getVar('video'),
      'isi' =>  $this->request->getVar('isi')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/tokohadmin');
  }


  // HAPUS DATA
  public function delete($id_tokoh)
  {
    // cari gambar berdasarkan id
    $tokoh = $this->tokohModel->find($id_tokoh);

    // cek jika file gambarnya default
    if($tokoh['gambar'] != 'defaultTokoh.jpeg') {
      // hapus gambar
    unlink('img/tokoh/' . $tokoh['gambar']);
    }

    $this->tokohModel->delete($id_tokoh);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/tokohadmin');
  }

  // EDIT
  public function edit($slug)
  {
    $data = [
      'title' =>  'Form Ubah Data Tokoh Kerajaan',
      'validation'  =>  \Config\Services::validation(),
      'tokoh'      => $this->tokohModel->getTokoh($slug),
    ];

    return view('admin/tokoh/edit', $data);
  }


  // UPDATE DATA
  public function update($id_tokoh)
  {
    // Cek Judul
    $tokohLama = $this->tokohModel->getTokoh($this->request->getVar('slug'));
    if($tokohLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = 'required';
    } else {
      $rule_judul = 'required|is_unique[tokoh.judul]';
    }

    // validasi input
    if(!$this->validate([
      'judul' => [
        'rules'   => $rule_judul,
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
      return redirect()->to('/tokohadmin/edit/' . $this->request->getVar('slug'))->withInput();
    }

    $fileGambar = $this->request->getFile('gambar');

    // cek gambar berubah atau tetap gambar lama
    if($fileGambar->getError() == 4) {
      $namaGambar = $this->request->getVar('gambarLama');
    } else {
      // generate nama gambar random
      $namaGambar = $fileGambar->getRandomName();
      $fileGambar->move('img/tokoh', $namaGambar);
      // hapus file lama
      unlink('img/tokoh/' . $this->request->getVar('gambarLama'));
    }


    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->tokohModel->save([
      'id_tokoh'    => $id_tokoh,
      'judul'       =>  $this->request->getVar('judul'),
      'slug'        =>  $slug,
      'sumber'      =>  $this->request->getVar('sumber'),
      'gambar'      =>  $namaGambar,
      'video'       =>  $this->request->getVar('video'),
      'isi'         =>  $this->request->getVar('isi')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');

    return redirect()->to('/tokohadmin');
  }
}