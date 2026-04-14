<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'password_hash'];
    protected $useTimestamps    = true;

    // Model Callbacks for automatic password hashing
    protected $beforeInsert     = ['hashPassword'];
    protected $beforeUpdate     = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password_hash'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}