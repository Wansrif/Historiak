<?php

namespace App\Controllers;

class Galeri extends BaseController
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
      'galeri'      => $galeri->orderBy('id_galeri', 'DESC')->paginate(6, 'galeri'),
      'pager'       => $this->galeriModel->pager,
      'currentPage' => $currentPage
    ];
    return view('user/galeri/index', $data);
  }


  public function detail($slug)
  {
    $data = [
      'title'  => 'Galeri',
      'galeri' => $this->galeriModel->getGaleri($slug)
    ];

  //  jika galeri tidak ada di tabel
  if (empty($data['galeri'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul galeri ' . $slug . ' tidak ditemukan.');
  }

  return view('user/galeri/detail', $data);
  }
}