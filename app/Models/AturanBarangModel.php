<?php

namespace App\Models;

use CodeIgniter\Model;

class AturanBarangModel extends Model
{
    protected $table      = 'tbl_aturan_barang';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType     = 'array';

    protected $allowedFields = [
        'dosis_aturan_barang',
        'khusus',
        'created_at',
        'updated_at'
    ];
}
