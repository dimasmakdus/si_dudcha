<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table      = 'tbl_permintaan_obat';
    protected $useTimestamps = true;
    protected $primaryKey = 'no_trans';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_permintaan',
        'no_trans',
        'supplier',
        'kode_obat',
        'nama_obat',
        'jenis_obat',
        'harga_beli',
        'jumlah',
        'satuan',
        'keterangan',
        'total',
        'tgl_transaksi',
        'created_at',
        'updated_at'
    ];
}
