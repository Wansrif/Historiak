<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'sumber', 'gambar', 'video', 'isi'];

    public function getGaleri($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('galeri')->like('judul', $keyword);
    }

    public function jmlGaleri()
    {
        return $this->countAll();
    }
}