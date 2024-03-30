<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Monitorings extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'monitorings'; 
    protected $fillable = ['monitoringID', 'researchID', 'progress', 'status', 'remarks', 'monitoringPersonnel', 'date'];

    // agencyID is a combination of acronym and number
    protected $primaryKey = 'monitoringID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'agencyID'
    public function getIdAttribute()
    {
        return $this->attributes['monitoringID'];
    }
}
