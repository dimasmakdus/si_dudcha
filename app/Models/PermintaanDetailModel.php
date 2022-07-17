<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanDetailModel extends Model
{
    protected $table      = 'tbl_permintaan_detail';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_permintaan',
        'kode_barang',
        'nama_barang',
        'satuan_barang_id',
        'stok',
        'harga_beli',
    ];
}
