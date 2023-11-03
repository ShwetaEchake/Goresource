<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationProcess extends Model
{
    public $guarded=[""];
    protected $table='application_process';
    protected $primaryKey='candidate_status_id';
}
