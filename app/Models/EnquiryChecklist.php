<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryChecklist extends Model
{
    
    public $guarded = [""];
    protected $table = 'enquiry_checklist';
    protected $primaryKey = 'checklist_id';
}
