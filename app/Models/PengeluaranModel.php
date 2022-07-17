<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table      = 'tbl_pengeluaran_barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'no_terima_barang';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_pengeluaran',
        'no_terima_barang',
        'nama_pasien',
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'dosis_aturan_barang',
        'jumlah',
        'satuan',
        'keterangan',
        'tgl_serah_barang',
        'created_at',
        'updated_at'
    ];
}
