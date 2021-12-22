<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'tbl_supplier';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_supplier';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_supplier',
        'nama_supplier',
        'alamat',
        'no_telpon',
        'email',
        'created_at',
        'updated_at'
    ];
}
