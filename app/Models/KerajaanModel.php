<?php

namespace App\Models;

use CodeIgniter\Model;

class KerajaanModel extends Model
{
    protected $table = 'kerajaan';
    protected $primaryKey = 'id_kerajaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'sumber', 'gambar', 'video', 'isi'];

    public function getKerajaan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('kerajaan')->like('judul', $keyword);
    }

    public function jmlKerajaan()
    {
        return $this->countAll();
    }
}