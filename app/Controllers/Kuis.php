<?php

namespace App\Controllers;

class Kuis extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Kuis'
    ];

    return view('user/kuis/index', $data);
  }

  public function soalkuis()
  {
    $data = [
      'title' => 'Kuis',
      'soal'  => $this->kuisModel->findAll()
    ];

    return view('user/kuis/kuis', $data);
  }

  public function hasil()
  {
    if ($this->request->getVar('unsetKuis') == 4 ) {
      session_unset();
    }

    $quest = $this->kuisModel->findAll();
    $data = [
      'title' => 'Hasil Kuis',
      'soal'  => $this->kuisModel->jmlKuis(),
    ];

    $data['score'] = 0;
    $x = [];
    foreach($quest as $value){
      $question = [];
      $data['jawaban'] = [];
      $selected_quiz = $this->request->getVar('quest' . $value['id_quiz']);

      $question = $this->kuisModel->select('*')->where('id_quiz',$value['id_quiz'])->first();
      $question['terpilih'] = $selected_quiz;
      if($question['jawaban'] == $selected_quiz){
        $data['score']++;
      }
      
      $data['jawaban'] = array_merge($data['jawaban'], (array) $question);
      $x[] = $data['jawaban'];
    }

    $data['hasil'] = $x;
    
    session()->setFlashdata('pesan', 'Selamat anda telah berhasil menyelesaikan kuis.');
    
    return view('user/kuis/hasil', $data);
  }
}