<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanBarangModel extends Model
{
    protected $table      = 'tbl_penjualan_barang';
    protected $primaryKey = 'id_transaksi';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_transaksi',
        'outlet_id',
        'outlet_name',
        'outlet_alamat',
        'sales',
        'tanggal',
        'no_nota',
        'total'
    ];
}
