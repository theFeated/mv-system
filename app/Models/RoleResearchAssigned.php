<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoleResearchAssigned extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'role_researchassigned'; 
    protected $fillable = ['id', 'roleID', 'researcherID', 'researchID'];

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
