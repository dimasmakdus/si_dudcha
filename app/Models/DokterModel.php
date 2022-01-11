<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table      = 'tbl_dokter';
    protected $primaryKey = 'kode_dokter';
    protected $useTimestamps = true;
    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_dokter',
        'nama_dokter',
        'jenis_kelamin',
        'nid',
        'tgl_lahir',
        'alamat',
        'poli',
        'created_at',
        'updated_at'
    ];
}
