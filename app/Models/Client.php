<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
   public $guarded=[""];
   protected $table='client';
   protected $primaryKey='client_id';

    public function user()
    {
      return $this->belongsTo(User::class,'id');

    }

          public function client()
       {
          return $this->hasMany(ClientLocation::class,'client_id');
       }
}
