<?php 

namespace Model;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

    //Definir la conexión a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar() {
        if (!is_null($this->id)){
            //Estamos actualizando
            $this->actualizar();
        } else {
            //Estamos creando nuevo registro
            $this->crear();

        }
    }

    public function crear() {
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //Insertar datos en la base de datos
        //Consulta
        $query = " INSERT INTO ". static::$tabla . " ( ";
        $query .= join(',',array_keys($atributos));
        $query .=  " ) VALUES ('";
        $query .= join("', '",array_values($atributos));
        $query .= "') ";
        

        //Realizar consulta - subir a la base de datos
        $resultado = self::$db->query($query);
        
        //Mesaje de exito o error
        if($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        };
    }

    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //Crear consulta
        $valores = [];
        foreach($atributos as $key=>$value) {
            $valores[]="{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ',$valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        //Subir a la base de datos
        $resultado = self::$db->query($query);
        
        if($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    
    }

    //Eliminar un registro
    public function eliminar(){
        //Eliminar la propiedad 
        $query = "DELETE FROM " . static::$tabla .  " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);

        //Redireccionar y borrar imagen
        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Identificiar y unir los atributos de la bd
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }
    
    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key=>$value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen) {
        //Eliminar la imagen previa (si actualizar)
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar el atributo imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        //Limpiar el arreglo
        static::$errores = [];
        //Validación del formulario   
        return static::$errores;
    }

    //Lista todas los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla; //permite llamar al valor del la clase heredada
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Obtiene determinado nº de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; 
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla .  " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
         return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        //crea un objeto de la clase actual (PROPIEDAD)
        $objeto = new static;

        foreach($registro as $key=>$value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
        
    }

    //Sincroniza los objetos en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        //Lo que hace comprobar si la clave del array esta en el objeto ($this creado con la función find() y sincronizar valores en ese objeto
        foreach($args as $key=>$value) {
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }   
    }
}