<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
     public $guarded=[""];
    protected $table='enrollment';
    protected $primaryKey='enrollment_id';
}
