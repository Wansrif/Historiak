<?php

namespace App\Controllers;

class Kerajaan extends BaseController
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
      'kerajaan'    => $kerajaan->orderBy('id_kerajaan', 'DESC')->paginate(6, 'kerajaan'),
      'pager'       => $this->kerajaanModel->pager,
      'currentPage' => $currentPage
    ];
    return view('user/kerajaan/index', $data);
  }


  public function detail($slug)
  {
    $data = [
      'title'    => 'Kerajaan',
      'kerajaan' => $this->kerajaanModel->getKerajaan($slug)
    ];

  //  jika kerajaan tidak ada di tabel
  if (empty($data['kerajaan'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul kerajaan ' . $slug . ' tidak ditemukan.');
  }

  return view('user/kerajaan/detail', $data);
  }
}