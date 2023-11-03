<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executive extends Model
{
    public $guarded = [""];
    protected $table = 'executive';
    protected $primaryKey = 'executive_id';
}
