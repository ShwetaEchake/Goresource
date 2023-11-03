<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    public $guarded=[""];
    protected $table='passport';
    protected $primaryKey='passport_id';

   
}
