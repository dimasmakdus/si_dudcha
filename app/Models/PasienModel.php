<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table      = 'tbl_pasien';
    protected $useTimestamps = true;
    protected $primaryKey = 'no_rekamedis';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'no_rekamedis',
        'no_ktp',
        'no_bpjs',
        'nama_pasien',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'status_pasien',
        'created_at',
        'updated_at'
    ];
}
