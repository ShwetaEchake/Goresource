<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    public $guarded=[""];
    protected $table='assessment';
    protected $primaryKey='assessment_id';
}
