<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    public $guarded=[""];
    protected $table='advertisment';
    protected $primaryKey='adv_id';
}
