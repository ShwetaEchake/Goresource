<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependents extends Model
{
    public $guarded=[""];
    protected $table='dependents';
    protected $primaryKey='dependent_id';

       public function dependents()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
