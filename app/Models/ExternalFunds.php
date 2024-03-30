<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExternalFunds extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'externalFunds'; 
    protected $fillable = ['exFundID', 'researchID', 'agencyID', 'contribution', 'purpose'];

    protected $primaryKey = 'exFundID';
    // Ensure Laravel knows the primary key is not auto-incrementing
    public $incrementing = false;
    // Define that the primary key 'id' should use the value of 'agencyID'
    public function getIdAttribute()
    {
        return $this->attributes['exFundID'];
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agencyID', 'agencyID');
    }
}
