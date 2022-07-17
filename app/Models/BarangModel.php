<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'tbl_barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_barang';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'stok',
        'satuan',
        'nilai_satuan',
        'harga_jual',
        'harga_beli',
        'tgl_kadaluarsa',
        'created_at',
        'updated_at'
    ];
}
