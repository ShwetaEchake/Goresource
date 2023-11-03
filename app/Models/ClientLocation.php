<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ClientLocation extends Model
{
   public $guarded=[""];
   protected $table='client_location';
   protected $primaryKey='client_location_id';


   public function clientlocation()
    {
      return $this->belongsTo(Client::class,'client_id');
    }


    
}
