<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table      = 'tbl_pasien';
    protected $useTimestamps = true;
    protected $primaryKey = 'no_resep';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'no_resep',
        'status_pasien',
        'no_bpjs',
        'nama_pasien',
        'jenis_kelamin',
        'umur',
        'alamat',
        'nama_dokter',
        'created_at',
        'updated_at'
    ];
}
