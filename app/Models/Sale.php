<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id_customer',
      'id_employee',
      '',
      'note',
      'total',
      'status'
    ];
}
