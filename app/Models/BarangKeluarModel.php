<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table      = 'tbl_bukti_barang_keluar';
    protected $useTimestamps = true;
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'penerima',
        'kecamatan',
        'laporan_bulan',
        'permintaan_bulan',
        'nama_barang',
        'expire',
        'batch',
        'anggaran',
        'pemberian',
        'satuan',
        'kemasan',
        'harga',
        'jumlah',
        'created_at',
        'updated_at'
    ];
}
