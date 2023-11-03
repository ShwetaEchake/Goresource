<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaProcess extends Model
{
    public $guarded=[""];
    protected $table='visa_process';
    protected $primaryKey='visa_id';
}
