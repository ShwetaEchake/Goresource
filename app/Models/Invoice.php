<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     public $guarded=[""];
    protected $table='invoice';
    protected $primaryKey='invoice_id';
}
