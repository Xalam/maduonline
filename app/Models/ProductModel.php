<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $useTimestamps = true;

    protected $allowedFields = ['product_name', 'product_image', 'product_price', 'product_description'];
}
