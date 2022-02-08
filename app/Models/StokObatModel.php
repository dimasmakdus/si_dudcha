<?php

namespace App\Models;

use CodeIgniter\Model;

class StokObatModel extends Model
{
    protected $table      = 'tbl_stok_obat';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_obat',
        'tanggal',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'tgl_kadaluarsa'
    ];
}
