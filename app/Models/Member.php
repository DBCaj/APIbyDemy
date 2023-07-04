<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table='members';

    protected $fillable=[
      'id',
      'name',
      'age',
      'email',
      'password',
      'created_at',
      'updated_at'  
    ];
}
