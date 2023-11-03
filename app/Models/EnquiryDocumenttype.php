<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryDocumenttype extends Model
{
    public $guarded = [""];
    protected $table = 'enquiry_documenttype';
    protected $primaryKey = 'enquiry_documenttype_id';
}
