<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateInterview extends Model
{
    
    public $guarded=[""];
    protected $table='candidate_interview';
    protected $primaryKey='candidate_interview_id';
}
