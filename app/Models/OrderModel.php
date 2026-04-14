<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'first_name', 'last_name', 'email', 'address', 'city', 
        'pin_code', 'country', 'phone', 'payment_method', 
        'subtotal', 'tax', 'total'
    ];

    protected $useTimestamps    = true;
}