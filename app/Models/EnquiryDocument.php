<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryDocument extends Model
{
    public $guarded=[""];
    protected $table='enquiry_documents';
    protected $primaryKey='enquiry_document_id';

  


     public function enquirydocument()
    {
        return $this->belongsTo(Enquiry::class,'enquiry_id');
    }


}
