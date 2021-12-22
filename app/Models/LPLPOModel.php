<?php

namespace App\Models;

use CodeIgniter\Model;

class LPLPOModel extends Model
{
    protected $table      = 'tbl_lplpo';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_obat';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_obat',
        'nama_obat',
        'jenis_obat',
        'stok_awal',
        'penerimaan',
        'persediaan',
        'pemakaian',
        'sisa_akhir',
        'stok_optimum',
        'permintaan',
        'pemberian',
        'keterangan',
        'created_at',
        'updated_at'
    ];
}
