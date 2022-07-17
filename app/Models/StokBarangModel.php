<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarangModel extends Model
{
    protected $table      = 'tbl_stok_barang';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_barang',
        'tanggal',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'tgl_kadaluarsa'
    ];
}
