<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'roles'; 
    protected $fillable = ['roleID', 'roleName', 'roleDescription'];

    // collegeID is a combination of acronym and number
    protected $primaryKey = 'roleID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'collegeID'
    public function getIdAttribute()
    {
        return $this->attributes['roleID'];
    }
}
