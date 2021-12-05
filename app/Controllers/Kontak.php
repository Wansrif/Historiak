<?php

namespace App\Controllers;

class Kontak extends BaseController
{
	public function index()
	{
		$data = [
      'title'       => 'Kontak',
      'validation'  => \Config\Services::validation()
    ];
    return view('user/kontak', $data);
	}

  public function kirim()
  {
    // validasi input
    if(!$this->validate([
      'nama'      => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required'  =>  'Masukkan nama terlebih dahulu.'
        ]
      ],
      'email'     => [
        'rules'   =>  'required|valid_email',
        'errors'  =>  [
          'required'    =>  'Masukkan email terlebih dahulu.',
          'valid_email' =>  'Email harus berisi alamat email yang valid.'
        ]
      ],
      'isi_pesan' => [
        'rules'   =>  'required',
        'errors'  =>  [
          'required'  =>  'Masukkan pesan terlebih dahulu.'
        ]
      ]
    ])) {
      return redirect()->to('/kontak')->withInput();
    }

    $slug = url_title($this->request->getVar('nama'), '-', true);
    $this->pesanModel->save([
      'nama'      => $this->request->getVar('nama'),
      'slug'      => $slug,
      'email'     => $this->request->getVar('email'),
      'isi_pesan' => $this->request->getVar('isi_pesan')
    ]);

    session()->setFlashdata('pesan', 'Pesan berhasil dikirim!');

    return redirect()->to('/kontak');
  }
}