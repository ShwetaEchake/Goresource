<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     public $guarded=[""];
    protected $table='categories';
    protected $primaryKey='category_id';

}
