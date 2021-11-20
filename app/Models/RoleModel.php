<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'tbl_role';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_role';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'nama_role',
        'created_at',
        'updated_at'
    ];
}
