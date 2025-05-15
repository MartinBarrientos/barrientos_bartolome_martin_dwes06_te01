<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use App\Models\Specs;
use App\Models\ArticuloDTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticuloController extends Controller
{
    
    public function todosArticulos(){
        $articulos = Articulo::with('specs')->get();
        return response()->json($articulos);
    }
    public function articuloId($id){
        $articulos = Articulo::with('specs')->where('id_articulo', $id)->first();
        if(!$articulos){
            http_response_code(404);
            return response()->json(['error'=>'id no encontrado en la base de datos'],http_response_code(404));
        }else{
            return response()->json(new ArticuloDTO($articulos));
        }

    }
    public function nuevoArticulo(Request $request){
        // Primero validamos los datos
        $request->validate([
            'nombre' => 'required|string',
            'precio'=> 'required|numeric',
            'descripcion'=>'string',
            'stock' => 'required|integer',
            'categoria' => 'required|string',
            'disponible' => 'required|boolean'
        ]);        
        //creamos el articulo en la tabla articulos
        $articulo = Articulo::create([
            'nombre' =>$request->input('nombre'),
            'descripcion' =>$request->input('descripcion'),
            'precio' =>$request->input('precio')
        ]);
        //ahora en la tabla specs metemos el resto de campos
        $specs = Specs::create([
            'id_articulo' =>$articulo->id_articulo,
            'stock' =>$request->input('stock'),
            'categoria' =>$request->input('categoria'),
            'disponible' =>$request->input('disponible')
        ]);

        //usamos load para volcar
        $articulo->load('specs');
        return response()->json(['mensaje' => 'datos insertados con exito','data'=>new ArticuloDTO($articulo)],201);
    }
    public function actualizarArticulo(Request $request, $id){
        //validaciones
        $request->validate([
            'nombre' => 'sometimes|string',
            'precio'=> 'sometimes|numeric',
            'descripcion'=>'sometimes|string',
            'stock' => 'sometimes|integer',
            'categoria' => 'sometimes|string',
            'disponible' => 'sometimes|boolean'
        ]);
        //ahora vamos a verificar que el articulo existe
        $articulo = Articulo::find($id);
        //si no existe lanzamos un error
        if(!$articulo){
            return response()->json(['error'=>'el articulo no existe']);
        }
        // Extraer campos que podrían venir del request de la parte de articulos
        $articulo->fill($request->only(['nombre', 'descripcion', 'precio']))->save();
        // Obtener o crear la spec asociada (por si no existe aún)
        $spec = $articulo->specs ?? new Specs(['id_articulo' => $id]);
        // Extraer campos que podrían venir del request de la parte de specs
        $spec->fill($request->only(['stock', 'categoria', 'disponible']))->save();

        // Recargar relación
        $articulo->load('specs');

        return response()->json([
            'mensaje' => 'Artículo actualizado correctamente',
            'data' => new ArticuloDTO($articulo)
        ],200);
    }
    public function eliminarArticulo($id){
        //primero hacemos un find
        $articulo = Articulo::find($id);
        if(!$articulo){
            return response()->json(['error' => 'articulo no encontrado'],404);
        }else{
            $articulo->delete();
            return response()->json(['mensaje' => 'Artículo eliminado correctamente'],200); 
        }
    }
}
