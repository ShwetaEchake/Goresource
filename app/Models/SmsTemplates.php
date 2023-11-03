<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTemplates extends Model
{
    public $guarded=[""];
    protected $table='sms_templates';
    protected $primaryKey='sms_template_id';
}
