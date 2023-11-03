<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreMedical extends Model
{
     public $guarded=[""];
    protected $table='pre_medical';
    protected $primaryKey='premedical_id';
}
