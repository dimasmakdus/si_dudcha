<?php

namespace App\Models;

use CodeIgniter\Model;

class AturanObatModel extends Model
{
    protected $table      = 'tbl_aturan_obat';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType     = 'array';

    protected $allowedFields = [
        'dosis_aturan_obat',
        'khusus',
        'created_at',
        'updated_at'
    ];
}
