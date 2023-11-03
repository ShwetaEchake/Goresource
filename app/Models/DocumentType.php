<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public $guarded=[""];
    protected $table='document_type';
    protected $primaryKey='document_type_id';
}
