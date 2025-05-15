<?php
//controlador que se conecta al microservicio de java
namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MicroservicioController extends Controller
{
    //
    //tenemos que llamar al microservicio de Java. Luego desde el microservicio consulta a la bbdd y mandar de vuelta la respuesta
    public function microservicio(){
        $respuesta = Http::get('http://localhost:8080/api/usuarios');

        //si la respuesta es exitosa mostramos los datos
        if($respuesta -> successful()){
            return response()->json($respuesta, 200);
        //de lo contrario error y cod 500
        }else{
            return response()->json(['Error' => 'no se ha establecido conexion con el microservicio java'], 500);
        }
    }
}
