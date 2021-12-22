<?php

namespace App\Models;

use CodeIgniter\Model;

class StokObatModel extends Model
{
    protected $table      = 'tbl_stok_obat';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_obat';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_obat',
        'nama_obat',
        'jumlah',
        'satuan',
        'created_at',
        'updated_at'
    ];
}
