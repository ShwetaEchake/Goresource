<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
public $guarded=[""];
    protected $table='template';
    protected $primaryKey='template_id';
}