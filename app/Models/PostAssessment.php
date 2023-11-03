<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAssessment extends Model
{
    public $guarded=[""];
    protected $table='post_assessment';
    protected $primaryKey='post_assessment_id';
}
