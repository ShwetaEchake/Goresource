<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
   public $guarded=[""];
   protected $table='locations';
   protected $primaryKey='location_id';
}
