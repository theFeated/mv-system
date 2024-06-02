<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExternalFunds extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'externalFunds'; 
    protected $fillable = ['id', 'researchID', 'agencyID', 'total_budget', 'budget_utilized', 'purpose'];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agencyID');
    }

    public function research()
    {
        return $this->belongsTo(Research::class, 'researchID');
    }
}
