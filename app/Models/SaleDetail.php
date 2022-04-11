<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'sale_details';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id_sale',
      'id_product',
      'quantity',
      'unit_price'
    ];
}
