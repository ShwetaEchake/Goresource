<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    public $guarded=[""];
    protected $table='seminar';
    protected $primaryKey='seminar_id';

     public function seminar()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
