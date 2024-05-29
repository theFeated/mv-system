<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'research'; 
    protected $primaryKey = 'researchID';
    protected $fillable = [
        'researchID', 'collegeID', 'researcherID', 'agencyID', 'status', 'researchTitle',
        'researchType', 'year', 'startDate', 'endDate', 'link_1', 'link_2',
        'link_3', 'extension', 'internalFund',
    ];

    public $incrementing = false;

    // Define that the primary key 'id' should use the value of 'researchID'
    public function getIdAttribute()
    {
        return $this->attributes['researchID'];
    }

    protected $casts = [
        'internalFund' => 'boolean',
    ];    
    
    public function college()
    {
        return $this->belongsTo(College::class, 'collegeID');
    }

    public function researcher()
    {
        return $this->belongsTo(Researcher::class, 'researcherID');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agencyID');
    }

}
