<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
       public $guarded=[""];
    protected $table='jobs';
    protected $primaryKey='job_id';
}
