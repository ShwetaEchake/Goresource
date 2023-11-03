<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    public $guarded=[""];
    protected $table='beneficiary';
    protected $primaryKey='beneficiary_id';

      public function beneficiary()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
