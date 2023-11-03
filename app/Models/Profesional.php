<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    public $guarded=[""];
    protected $table='profesional';
    protected $primaryKey='profession_id';

      public function profesional()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
