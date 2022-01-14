<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepDetailModel extends Model
{
    protected $table      = 'tbl_resep_detail';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_transaksi',
        'kode_obat',
        'nama_obat',
        'jumlah',
        'satuan'
    ];
}
