<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Personal extends Model implements FromCollection, WithMapping, WithHeadings
{
    public $guarded=[""];
    protected $table='personal';
    protected $primaryKey='candidate_id';


protected $id;
 function __construct($id=''){
        $this->id = $id;
 }



  public function collection()
    {
        
         return Personal::leftjoin('country','country.country_id','=','personal.citizenship')
         ->leftjoin('branch','branch.branch_id','=','personal.branch_id')
         ->whereIn('personal.candidate_id',$this->id)->get();
    }


  public function map($personal): array
    {
        return [
               
               $personal->name." ".$personal->last_name,
               $personal->age,
               $personal->gender,
               $personal->country_name ,
               $personal->merital_status  ,
               $personal->religion,
               $personal->mobile_no,
               $personal->email,
               $personal->mobile_no2,
               $personal->email2,
               $personal->date_of_birth, 
               $personal->place_of_birth,
               $personal->height,
               $personal->weight,
               $personal->language,
               $personal->other_skill,
               $personal->computer_skill,
               $personal->hobbies_sport,
               $personal->aadhar_card,
               $personal->pan_card,
               $personal->driving_licence,
               $personal->branch_name,
               date('d-m-Y',strtotime($personal->created_at)),
             
        ];
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Age',
            'Gender',
            'Citizenship',
            'Merital Status',
            'Religion',
            'Mobile No',
            'Email',
            'Mobile No.2',
            'Email.2',
            'Date of birth',
            'Place of birth',
            'Height',
            'Weight',
            'Language',
            'Other Skill',
            'Computer Skill',
            'Hobbies Sport',
            'Aadhar Card',
            'Pan Card',
            'Driving Licence',
            'Branch Name',
            'Created at'
        ];
    }



       public function edu()
       {
    	    return $this->hasMany(Education::class,'candidate_id');
       }


       public function prof()
       {
          return $this->hasMany(Profesional::class,'candidate_id');
       }

         public function exp()
       {
          return $this->hasMany(Experience::class,'candidate_id');
       }

            public function sem()
       {
          return $this->hasMany(Seminar::class,'candidate_id');
       }

            public function ben()
       {
          return $this->hasMany(Beneficiary::class,'candidate_id');
       }

        public function dep()
       {
          return $this->hasMany(Dependents::class,'candidate_id');
       }

          public function document()
       {
          return $this->hasMany(CandidateDocument::class,'candidate_id');
       }

          
}
