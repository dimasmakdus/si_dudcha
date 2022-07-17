<?php

namespace App\Models;

use CodeIgniter\Model;

class OutletModel extends Model
{
    protected $table      = 'tbl_outlet';
    protected $useTimestamps = true;
    protected $primaryKey = 'outlet_id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'outlet_id',
        'outlet_name',
        'outlet_alamat',
        'outlet_status',
        'created_at',
        'updated_at'
    ];
}
