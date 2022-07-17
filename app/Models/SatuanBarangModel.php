<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanBarangModel extends Model
{
    protected $table      = 'tbl_satuan_barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'satuan_barang_id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'satuan_barang_name',
        'created_at',
        'updated_at'
    ];
}
