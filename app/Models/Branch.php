<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $guarded=[""];
    protected $table='branch';
    protected $primaryKey='branch_id';
}
