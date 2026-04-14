<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // Explicitly define which columns can be manipulated (Security: Mass Assignment protection)
    protected $allowedFields    = ['name', 'slug'];

    protected $useTimestamps    = true; // Automatically handles created_at and updated_at
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}