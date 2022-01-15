<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table      = 'tbl_permintaan';
    // protected $useTimestamps = true;
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id',
        'kode_pesanan',
        'tanggal',
        'kode_supplier',
        'status',
        'proses',
        'keterangan',
        'total'
    ];
}
