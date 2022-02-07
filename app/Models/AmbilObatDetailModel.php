<?php

namespace App\Models;

use CodeIgniter\Model;

class AmbilObatDetailModel extends Model
{
    protected $table      = 'tbl_ambil_obat_detail';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_transaksi',
        'kode_obat',
        'nama_obat',
        'jumlah',
        'satuan',
        'dosis_aturan_obat'
    ];
}
