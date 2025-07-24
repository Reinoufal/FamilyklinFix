<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionValueCombination extends Model
{
    protected $fillable = [
        'product_id',
        'layanan_value_id',
        'ukuran_value_id',
        'price',
    ];
} 