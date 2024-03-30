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
    
}
