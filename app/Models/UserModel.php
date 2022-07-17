<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tbl_user';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'full_name',
        'email',
        'password',
        'id_user_role',
        'is_active',
        'user_photo',
        'created_at',
        'updated_at'
    ];
}
