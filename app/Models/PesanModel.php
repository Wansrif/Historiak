<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';
    protected $useTimestamps = true;
    protected $updatedField;
    protected $allowedFields = ['nama', 'slug', 'email', 'isi_pesan'];

    public function getPesan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('pesan')->like('nama', $keyword);
    }

    public function jmlPesan()
    {
        return $this->countAll();
    }
}