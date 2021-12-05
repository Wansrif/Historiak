<?php

namespace App\Models;

use CodeIgniter\Model;

class TokohModel extends Model
{
    protected $table = 'tokoh';
    protected $primaryKey = 'id_tokoh';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'sumber', 'gambar', 'video', 'isi'];

    public function getTokoh($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('tokoh')->like('judul', $keyword);
    }

    public function jmlTokoh()
    {
        return $this->countAll();
    }
}