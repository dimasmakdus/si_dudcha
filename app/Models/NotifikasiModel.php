<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table      = 'tbl_notifikasi';
    protected $useTimestamps = true;
    protected $primaryKey = 'notifikasi_id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'notifikasi_user_id',
        'notifikasi_judul',
        'notifikasi_pesan',
        'notifikasi_tanggal',
        'notifikasi_url',
    ];
}
