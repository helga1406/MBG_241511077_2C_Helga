<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // tabel di DB
    protected $primaryKey = 'id';

    // field yang boleh diisi
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'created_at',
    ];

    // biar return array (bukan object)
    protected $returnType = 'array';
}
