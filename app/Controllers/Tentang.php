<?php

namespace App\Controllers;

class Tentang extends BaseController
{
	public function index()
  {
    $data = [
      'title' => 'Tentang'
    ];
    return view('user/tentang', $data);
  }
}