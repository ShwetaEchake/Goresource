<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;
class Education extends Model
{
     public $guarded=[""];
    protected $table='education';
    protected $primaryKey='education_id';

    public function education()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }

}
