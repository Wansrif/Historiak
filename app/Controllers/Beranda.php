<?php

namespace App\Controllers;

class Beranda extends BaseController
{
	public function index()
	{
		$limits = 4;
    $data = [
      'title' => 'Beranda | HistoriaK',
			'galeri'  => $this->galeriModel->orderBy('id_galeri', 'DESC')->findAll($limits),
			'kerajaan'  => $this->kerajaanModel->orderBy('id_kerajaan', 'DESC')->findAll($limits),
			'tokoh'  => $this->tokohModel->orderBy('id_tokoh', 'DESC')->findAll($limits),
    ];
		return view('user/Beranda', $data);
	}
}