<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Monitorings extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'monitorings'; 
    protected $fillable = ['id', 'researchID', 'progress', 'status', 'remarks', 'monitoringPersonnel', 'date'];

    public function research()
    {
        return $this->belongsTo(Research::class, 'researchID');
    }
}
