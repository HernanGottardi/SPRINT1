<?php

// http://localhost/phpmyadmin/

class ConexionDB
{
    public static $objetoConexion;
    public $objetoPDO;


    private function __construct()
{
    try
    { 
        $this->objetoPDO = new PDO('mysql:host=localhost;dbname=restaurante;charset=utf8', 'root', '', array(
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));

        $this->objetoPDO->exec("SET CHARACTER SET utf8");
        //$this->objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) 
    { 
        echo "Error de conexión: " . $e->getMessage();
        exit; // Salir del script para evitar más errores.
    }
}


    public function __clone(){ 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }

    public static function acceso()
    { 
        if (!isset(self::$objetoConexion)) 
        {          
            self::$objetoConexion = new ConexionDB(); 
        } 
        return self::$objetoConexion;        
    }

    public function consulta($sql)
    { 
        return $this->objetoPDO->prepare($sql);   
    }

    public function ultimoId()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
}



?>