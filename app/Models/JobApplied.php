<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobApplied extends Model  implements FromCollection, WithMapping, WithHeadings
{
    public $guarded=[""];
    protected $table='job_applied';
    protected $primaryKey='applied_id';


 protected $ids;
 function __construct($ids=''){
        $this->ids = $ids;
 }



  public function collection()
    {
        
         return JobApplied::leftJoin('personal', 'job_applied.candidate_id', '=', 'personal.candidate_id')
                  ->whereIn('job_applied.candidate_id',$this->ids)->get();
    }


  public function map($jobapplied): array
    {
        return [
               
    
               $jobapplied->name." ".$jobapplied->last_name,
               $jobapplied->age,
               $jobapplied->gender,
               $jobapplied->citizenship ,
               $jobapplied->merital_status  ,
               $jobapplied->religion,
               $jobapplied->current_status
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Age',
            'Gender',
            'Citizenship',
            'Merital Status',
            'Religion',
            'Current Status'
            
        ];
    }

   




    }
