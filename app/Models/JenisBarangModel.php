<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisBarangModel extends Model
{
    protected $table      = 'tbl_jenis_barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'jenis_barang_id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'jenis_barang_name',
        'created_at',
        'updated_at'
    ];
}
