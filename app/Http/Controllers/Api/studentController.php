<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){
     // Función para agregar estudiantes
        $data = []; //Crea un array vacio
        $validator = Validator::make($request->all(), [ // validacion de datos recibidos del cliente
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:student',
            'phone'=> 'required|digits:12',
            'languaje'=>'required|in:Español,Inglés,Portugués,Francés'
        ]);
        if($validator->fails()){
            $data ['students']=[];
            $data ['mensaje']='Error en la validación de datos';
            $data ['status']=400;
            $data ['errores']=$validator->errors();
            return response()->json($data, 400);
        }
        $student = Student::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'language'=> $request->languaje
        ]);
        if(!$student){ // Si no pudo crear el estudiante
            $data ['students']=[];
            $data ['mensaje']='Error al crear estudiante';
            $data ['status']=500;
            return response()->json($data, 500);
        }
        $data ['students']=$student;
        $data ['mensaje']='Estudiante registrado';
        $data ['status']=201;
        return response()->json($data, 201);
    }

    public function show($id){

        // Función para retornar el dato de un solo estudiante';
        $data = []; //Crea un array vacio
        $student = Student::find($id); //Buscar estudiante
        if(!$student){ // Si no se encontró el estudiante]
            $data ['student']=[];
            $data ['mensaje']='Estudiante no encontrado';
            $data ['status']=404;
            return response()->json($data, 404);
        }
        $data = [
            'student' => $student,
            'mensaje' => '',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id){

        // Función para eliminar el dato de un solo estudiante';
        $data = []; //Crea un array vacio
        $student = Student::find($id); //Buscar estudiante
        if(!$student){ // Si no se encontró el estudiante]
            $data ['student']=[];
            $data ['mensaje']='Estudiante no encontrado';
            $data ['status']=404;
            return response()->json($data, 404);
        }
        $student->delete();
        $data = [
            'student' => [],
            'mensaje' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
        // Función para modificar dato de un estudiante
        $data = []; //Crea un array vacio
        $student = Student::find($id); //Buscar estudiante
        if(!$student){ // Si no se encontró el estudiante]
            $data ['student']=[];
            $data ['mensaje']='Estudiante no encontrado';
            $data ['status']=404;
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [ // validacion de datos recibidos del cliente
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:student',
            'phone'=> 'required|digits:12',
            'language'=>'required|in:Español,Inglés,Portugués,Francés'
        ]);
        if($validator->fails()){// Si falló la validación
            $data ['student']=[];
            $data ['mensaje']='Error en la validación de datos';
            $data ['status']=400;
            $data ['errores']=$validator->errors();
            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->language = $request->language;
        $student->save(); // actualiza registro de estudiante

        $data ['students']=$student;
        $data ['mensaje']='Estudiante actualizado';
        $data ['status']=200;
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id){
        // Función para modificar dato de un estudiante
        $data = []; //Crea un array vacio
        $student = Student::find($id); //Buscar estudiante
        if(!$student){ // Si no se encontró el estudiante]
            $data ['student']=[];
            $data ['mensaje']='Estudiante no encontrado';
            $data ['status']=404;
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [ // validacion de datos recibidos del cliente
            'name'=> 'max:255',
            'email'=> 'email|unique:student',
            'phone'=> 'digits:12',
            'language'=>'in:Español,Inglés,Portugués,Francés'
        ]);
        if($validator->fails()){// Si falló la validación
            $data ['student']=[];
            $data ['mensaje']='Error en la validación de datos';
            $data ['status']=400;
            $data ['errores']=$validator->errors();
            return response()->json($data, 400);
        }

        if($request->has('name')){ // Si el objeto $request tiene una propiedad nombre
            $student->name = $request->name;
        }
        if($request->has('email')){
            $student->email = $request->email;
        }
        if($request->has('phone')){ // Si el objeto $request tiene una propiedad teléfono
            $student->phone = $request->phone;
        }
        if($request->has('language')){
            $student->language = $request->language;
        }
        $student->save(); // actualiza registro de estudiante

        $data ['students']=$student;
        $data ['mensaje']='Estudiante actualizado';
        $data ['status']=200;
        return response()->json($data, 200);
    }
}
