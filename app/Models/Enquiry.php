<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    public $guarded=[""];
    protected $table='enquiry';
    protected $primaryKey='enquiry_id';


         public function document()
       {
          return $this->hasMany(EnquiryDocument::class,'enquiry_id');
       }


}
