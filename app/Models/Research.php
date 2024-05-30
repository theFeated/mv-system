<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'research'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'collegeID', 'researcherID', 'agencyID', 'status', 'researchTitle',
        'researchType', 'startDate', 'endDate', 'link_1', 'link_2',
        'link_3', 'extension', 'isInternalFund',
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
