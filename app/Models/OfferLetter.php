<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferLetter extends Model
{
    public $guarded=[""];
    protected $table='offer_letter';
    protected $primaryKey='offer_letter_id';
}
