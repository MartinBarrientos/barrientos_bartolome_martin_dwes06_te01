<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //nombre de la tabla en la BD
    protected $table ="articulos";
    //la llave primaria personalizada
    protected $primaryKey="id_articulo";
    //no tiene registros
    public $timestamps = false;
    //campos
    protected $fillable =['nombre','descripcion','precio'];

    // Relacion -> un artículo tiene una especificacion
    public function specs()
    {
        return $this->hasOne(Specs::class, 'id_articulo', 'id_articulo');
    }
    
}
