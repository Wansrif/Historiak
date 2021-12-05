<?php

namespace App\Models;

use CodeIgniter\Model;

class KuisModel extends Model
{
    protected $table = 'kuis';
    protected $primaryKey = 'id_quiz';
    protected $useTimestamps = true;
    protected $allowedFields = ['pertanyaan', 'slug', 'pilihan1', 'pilihan2', 'pilihan3', 'jawaban'];

    public function getKuis($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('kuis')->like('pertanyaan', $keyword);
    }

    public function jmlKuis()
    {
        return $this->countAll();
    }
}