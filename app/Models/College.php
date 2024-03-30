<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class College extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'college'; 
    protected $fillable = ['collegeID', 'collegeName', 'collegeDean'];

    // collegeID is a combination of acronym and number
    protected $primaryKey = 'collegeID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'collegeID'
    public function getIdAttribute()
    {
        return $this->attributes['collegeID'];
    }
}
