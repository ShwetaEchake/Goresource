<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QvcProcess extends Model
{
   public $guarded=[""];
    protected $table='qvc_process';
    protected $primaryKey='qvc_id';
}
