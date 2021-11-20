<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table      = 'tbl_resep_obat';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_resep';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'nama_obat',
        'jenis_obat',
        'dosis_aturan_obat',
        'jumlah_obat',
        'no_rawat',
        'no_rekamedis',
        'tanggal',
        'created_at',
        'updated_at'
    ];
}
