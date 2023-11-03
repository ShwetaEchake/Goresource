<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    public $guarded=[""];
    protected $table='email_templates';
    protected $primaryKey='email_template_id';
}
