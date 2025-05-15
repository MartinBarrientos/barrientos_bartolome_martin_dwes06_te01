<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticuloDTO
{
    public $id_articulo;
    public $nombre;
    public $precio;
    public $descripcion;
    public $stock;
    public $categoria;
    public $disponible;

    public function __construct($articulo)
    {
        $this->id_articulo = $articulo->id_articulo;
        $this->nombre = $articulo->nombre;
        $this->precio = $articulo->precio;
        $this->descripcion = $articulo->descripcion;

        // Aquí accedemos a la relación 'specs'
        $this->stock = $articulo->specs->stock ?? null;
        $this->categoria = $articulo->specs->categoria ?? null;
        $this->disponible = $articulo->specs->disponible ?? null;
    }
}