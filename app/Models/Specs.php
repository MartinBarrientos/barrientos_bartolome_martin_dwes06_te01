<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    //nombre de la tabla en la BD
    protected $table ="specs";
    //la llave primaria personalizada
    protected $primaryKey="id_articulo";
    //no tiene registros
    public $timestamps = false;
    //campos
    protected $fillable =['id_articulo','stock','categoria','disponible'];

    //ocultamos el id_articulo de esta tabla para que en la consulta no salga duplicado
    protected $hidden =['id_articulo'];

    // Relacion -> una spec pertenece a un artículo
    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'id_articulo', 'id_articulo');
    }
}
