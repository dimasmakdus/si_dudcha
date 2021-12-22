<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model
{
    protected $table      = 'tbl_akses';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'nama_akses',
        'icon',
        'path',
        'no_roder'
    ];
}
