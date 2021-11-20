<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table      = 'tbl_pengeluaran_obat';
    protected $useTimestamps = true;
    protected $primaryKey = 'no_terima_obat';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_pengeluaran',
        'nama_pasien',
        'kode_obat',
        'nama_obat',
        'jenis_obat',
        'dosis_aturan_obat',
        'jumlah',
        'satuan',
        'keterangan',
        'tgl_serah_obat',
        'created_at',
        'updated_at'
    ];
}
