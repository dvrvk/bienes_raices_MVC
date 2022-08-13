<?php 

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';

    }

    public function validar() {

        //Validación del formulario
        if(!$this->nombre) {
            self::$errores[] ="El nombre es obligatorio";
        }

        if(!$this->apellido) {
            self::$errores[] ="El apellido es obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] ="El teléfono es obligatorio";
        } elseif (!preg_match('/[0-9]{9}/', $this->telefono)) { //Buscar un patrón dentro de un texto (expresión regular)
            self::$errores[] ="Formato no valido";
        }

        return self::$errores;
    }
}