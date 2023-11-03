<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $guarded=[""];
    protected $table='experience';
    protected $primaryKey='experience_id';

    public function experience()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
