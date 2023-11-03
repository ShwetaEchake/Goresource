<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;




class Reports extends Model implements WithDrawings
{
    public $guarded=[""];
    protected $table='reports';
    protected $primaryKey='';

//     public function drawings()
// {
//     $drawing = new Drawing();
//     $drawing->setName('Logo');
//     $drawing->setDescription('This is my logo');
//     $drawing->setPath(public_path('/img/image1.png'));
//     $drawing->setHeight(90);
//     $drawing->setCoordinates('B3');

//     return $drawing;
// }


}
