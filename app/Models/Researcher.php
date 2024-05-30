<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Researcher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'researcher'; 
    protected $fillable = ['id', 'collegeID', 'researcherName', 'email', 'contactNum'];

}
