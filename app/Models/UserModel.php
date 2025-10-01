<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // pastikan tabel di DB kamu namanya `users`
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'created_at'
    ];
}
