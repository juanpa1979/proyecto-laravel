<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index(){

        // return 'Obteniendo lista de Estudiantes desde el controller';
        //$students = Student::all();
        $data = []; //Crea un array vacio
        $data ['students'] = Student::all();
        $students = Student::all();
        if($data['students']->isEmpty()){
            $data ['mensaje']='No se encontraron estudiantes registrados';
            $data ['status']=200;
        } else {
            $data ['mensaje']='Lista de Estudiantes';
            $data ['status']=200;
        }
        return response()->json($data, 200);
    }
}
