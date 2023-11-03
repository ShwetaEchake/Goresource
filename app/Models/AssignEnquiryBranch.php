<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignEnquiryBranch extends Model
{
    public $guarded=[""];
    protected $table='assign_enquiry_branch';
    protected $primaryKey='enquiry_branch_id';
    public $timestamp='false';
}


