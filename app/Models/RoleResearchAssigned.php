<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoleResearchAssigned extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'role_researchassigned'; 
    protected $fillable = ['assignedID', 'roleID', 'researcherID', 'researchID'];

    protected $primaryKey = 'assignedID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'agencyID'
    public function getIdAttribute()
    {
        return $this->attributes['assignedID'];
    }

    public function researcher()
    {
        return $this->belongsTo(Researcher::class, 'researcherID');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'roleID');
    }

    public function research()
    {
        return $this->belongsTo(Research::class, 'researchID');
    }

}
