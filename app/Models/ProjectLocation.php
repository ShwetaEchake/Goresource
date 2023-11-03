<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    public $guarded=[""];
    protected $table='project_location';
    protected $primaryKey='enquiy_project_location_id';
}
