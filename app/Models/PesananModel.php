<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table      = 'tbl_pesanan';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_pesanan';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'satuan',
        'jumlah',
        'nama_supplier',
        'email_supplier',
        'status',
        'created_at',
        'updated_at',
    ];
}
