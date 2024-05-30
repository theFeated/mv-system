<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agency extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'agency'; 
    protected $fillable = ['id', 'agencyName', 'contactPerson', 'address', 'telNum'];

}
