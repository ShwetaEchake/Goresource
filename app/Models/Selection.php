<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    public $guarded=[""];
    protected $table='selection';
    protected $primaryKey='selection_id';
}
