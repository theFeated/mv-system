<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Researcher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'researcher'; 
    protected $fillable = ['researcherID', 'collegeID', 'researcherName', 'email', 'contactNum'];

    // researchID is a combination of acronym and number
    protected $primaryKey = 'researcherID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'researchID'
    public function getIdAttribute()
    {
        return $this->attributes['researcherID'];
    }
}
