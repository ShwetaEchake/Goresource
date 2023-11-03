<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    public $guarded=[""];
    protected $table='interview';
    protected $primaryKey='interview_id';
}
