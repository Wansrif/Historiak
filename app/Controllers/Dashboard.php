<?php

namespace App\Controllers;


class Dashboard extends BaseController
{
	public function index()
	{
    $data = [
      'title'     => 'Dashboard',
      'kerajaan'  => $this->kerajaanModel->jmlKerajaan(),
      'tokoh'     => $this->tokohModel->jmlTokoh(),
      'galeri'    => $this->galeriModel->jmlGaleri(),
      'pesan'     => $this->pesanModel->jmlPesan(),
      'kuis'      => $this->kuisModel->jmlKuis(),
    ];
		return view('admin/dashboard', $data);
	}
}