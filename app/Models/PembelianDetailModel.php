<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianDetailModel extends Model
{
    protected $table      = 'tbl_pembelian_detail';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_pembelian',
        'kode_pemesanan',
        'kode_barang',
        'stok_masuk',
        'tgl_kadaluarsa',
        'harga_beli',
        'satuan_barang_id',
        'stok_pemesanan',
        'harga_pemesanan',
    ];
}
