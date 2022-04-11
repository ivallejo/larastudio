<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
      'code',
      'product',
      'description',
      'type',
      'unit_price',
      'percent_employee',
      'quantity',
      'status',
    ];
}
