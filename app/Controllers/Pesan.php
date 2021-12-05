<?php

namespace App\Controllers;


class Pesan extends BaseController
{
  public function index()
	{
    $currentPage = $this->request->getVar('page_pesan') ? $this->request->getVar('page_pesan') : 1;

    $keyword = $this->request->getVar('keyword');
    if($keyword) {
      $pesan = $this->pesanModel->search($keyword);
    } else {
      $pesan = $this->pesanModel;
    }

    $data = [
      'title'       => 'Pesan',
      'pesan'       => $pesan->orderBy('id_pesan', 'DESC')->paginate(5, 'pesan'),
      'pager'       => $this->pesanModel->pager,
      'currentPage' => $currentPage
    ];
		return view('admin/pesan/index', $data);
	}


  // DETAIL PESAN
  public function detail($slug)
  {
    $data = [
      'title' => 'Detail Pesan',
      'pesan' => $this->pesanModel->getPesan($slug),
    ];

    return view('admin/pesan/detail', $data);
  }


  // DELETE PESAN
  public function delete($id_pesan)
  {
    $this->pesanModel->delete($id_pesan);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/pesan');
  }
}