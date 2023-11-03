<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalExaminationCenter extends Model
{
    public $guarded=[""];
    protected $table='medical_examination_center';
    protected $primaryKey='medical_examination_center_id';
}
