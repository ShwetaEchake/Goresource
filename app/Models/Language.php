<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
   
    public $guarded=[""];
    protected $table='language';
    protected $primaryKey='language_id';
}
