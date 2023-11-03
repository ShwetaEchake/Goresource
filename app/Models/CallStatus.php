<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallStatus extends Model
{
    public $guarded=[""];
    protected $table='call_status';
    protected $primaryKey='call_status_id';
}
