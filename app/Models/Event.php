<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id_customer',
      'id_product',
      'title',
      'note',
      'total',
      'date_event',
      'time_event',
    ];
}
