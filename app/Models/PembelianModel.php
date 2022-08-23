<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table      = 'tbl_pembelian';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'faktur',
        'kode_pemesanan',
        'tanggal',
        'total',
        'kode_supplier',
        'status_pembayaran',
        'tgl_jatuh_tempo'
    ];
}
