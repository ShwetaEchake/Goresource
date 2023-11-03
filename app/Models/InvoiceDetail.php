<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
     public $guarded=[""];
    protected $table='invoice_detail';
    protected $primaryKey='invoice_detail_id';
}
