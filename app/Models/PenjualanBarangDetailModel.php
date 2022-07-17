<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanBarangDetailModel extends Model
{
    protected $table      = 'tbl_penjualan_barang_detail';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_transaksi',
        'kode_barang',
        'nama_barang',
        'jumlah',
        'satuan',
        'harga_jual',
    ];
}
