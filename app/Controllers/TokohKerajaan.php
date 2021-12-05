<?php

namespace App\Controllers;

class TokohKerajaan extends BaseController
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
      'tokoh'       => $tokoh->orderBy('id_tokoh', 'DESC')->paginate(6, 'tokoh'),
      'pager'       => $this->tokohModel->pager,
      'currentPage' => $currentPage
    ];
    return view('user/tokoh/index', $data);
	}

  
  public function detail($slug)
  {
    $data = [
      'title'  => 'Tokoh Kerajaan',
      'tokoh' => $this->tokohModel->getTokoh($slug)
    ];

  //  jika tokoh tidak ada di tabel
  if (empty($data['tokoh'])) {
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul tokoh ' . $slug . ' tidak ditemukan.');
  }

  return view('user/tokoh/detail', $data);
  }
}