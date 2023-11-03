<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;

class CandidateDocument extends Model
{
    public $guarded=[""];
    protected $table='candidate_documents';
    protected $primaryKey='document_id';


     public function candidatedocument()
    {
    	return $this->belongsTo(Personal::class,'candidate_id');
    }
}
