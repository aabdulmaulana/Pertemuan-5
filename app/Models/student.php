<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    #membuat fungsi getStudents di model Student
    public function getStudents () {
        # menggunakan query sql untuk mengambil data
        $students=DB::select('select * from students');
        return $students;
    }
    
}
