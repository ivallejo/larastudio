<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
      'document',
      'first_name',
      'last_name',
      'phone',
      'email',
      'birthday',
      'address',
      'gender',
      'note',
      'status'
    ];
}
