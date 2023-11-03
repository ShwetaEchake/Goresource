<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
     public $guarded=[""];
    protected $table='deployment_process';
    protected $primaryKey='deployment_id';

}
