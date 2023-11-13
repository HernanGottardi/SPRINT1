<?php

include_once(__DIR__ . '/../DB/conexionDB.php');
include_once(__DIR__ . './model/Empleado.php');

class Usuario
{
    //--- Attributes ---//
    public $id;
    public $nombre_usuario;
    public $contraseña;
    public $esAdmin;
    public $tipo_empleado;
    public $estado;
    public $fecha_inicio;
    public $fecha_fin;

    //--- Default Constructor ---//
    public function __construct(){}

    public static function crearUsuario($nombreUsuario, $contraseña, $esAdmin, $tipo_empleado, $estado, $fechaInicio)
    {
        $user = new Usuario();
        $user->setNombreUsuario($nombreUsuario);
        $user->setContraseña($contraseña);
        $user->setEsAdmin($esAdmin);
        $user->setTipoUsuario($tipo_empleado);
        $user->setEstado($estado);
        $user->setFechaInicio($fechaInicio);
        return $user;
    }

    public function getId() 
    {
        return $this->id;
    }
    public function setId($id) 
    {
        $this->id = $id;
    }
    public function getNombreUsuario() 
    {
        return $this->nombre_usuario;
    }

    public function setNombreUsuario($nombre_usuario) 
    {
        $this->nombre_usuario = $nombre_usuario;
    }
    public function getContraseña() 
    {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) 
    {
        $this->contraseña = $contraseña;
    }

    public function getEsAdmin() {
        return $this->esAdmin;
    }

    public function setEsAdmin($esAdmin) 
    {
        $this->esAdmin = $esAdmin;
    }

    public function getTipoUsuario() 
    {
        return $this->tipo_empleado;
    }

    public function setTipoUsuario($tipo_usuario) 
    {
        $this->tipo_empleado = $tipo_usuario;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) 
    {
        $this->estado = $estado;
    }

    public function getFechaInicio() 
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio) 
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFinal() 
    {
        return $this->fecha_fin;
    }

    public function setFechaFinal($fecha_final) 
    {
        $this->fecha_final = $fecha_final;
    }
    

    public static function agregarUsuario($usuario)
    {
        $instancia = ConexionDB::acceso();
    
        $consulta = $instancia->consulta("INSERT INTO usuario (nombre_usuario, contraseña, esAdmin, tipo_empleado, estado, fecha_inicio) 
        VALUES (:nombreUsuario, :contra, :esAdmin, :tipoUsuario, :estado, :fechaInicio)");
        
        $consulta->bindValue(':nombreUsuario', $usuario->getNombreUsuario(), PDO::PARAM_STR);
        $consulta->bindValue(':contra', $usuario->getContraseña(), PDO::PARAM_STR);
        $consulta->bindValue(':esAdmin', $usuario->getEsAdmin(), PDO::PARAM_INT);
        $consulta->bindValue(':tipoUsuario', $usuario->getTipoUsuario(), PDO::PARAM_STR);
        $consulta->bindValue(':estado', $usuario->getEstado(), PDO::PARAM_STR);
        $consulta->bindValue(':fechaInicio', $usuario->getFechaInicio(), PDO::PARAM_STR);
        
        return $consulta->execute();
    }


    public static function obtenerUsuarios()
    {

        $instancia = ConexionDB::acceso();
        $consulta = $instancia->consulta("SELECT * FROM usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function modificarUsuario($usuario){

        $instancia = ConexionDB::acceso();
        $consulta = $instancia->consulta("UPDATE usuario SET nombre_usuario = :nombre_usuario, contraseña = :contraseña WHERE id = :id");
        
        try 
        {
            $consulta->bindValue(':nombre_usuario', $usuario->getNombreUsuario(), PDO::PARAM_STR);
            $consulta->bindValue(':contraseña', $usuario->getContraseña(), PDO::PARAM_STR);
            $consulta->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } 
        catch (\Throwable $th) 
        {
            echo $th->getMessage();
        }

        return $consulta;
    }

    public static function obtenerUsuarioPorID($id)
    {
        $instancia = ConexionDB::acceso();
        
        $consulta = $instancia->consulta("SELECT * FROM usuario WHERE id = :id");
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        $consulta->execute();
        $usuario = $consulta->fetchObject('Usuario');

        if(is_null($usuario))
        {
            throw new Exception("usuario no encontrado. </br>");
        }
        return $usuario;
    }


    public static function eliminarUsuario($usuario)
    {

        $instancia = ConexionDB::acceso();
        
        $consulta = $instancia->consulta("DELETE FROM usuario WHERE id = :id");
        $consulta->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
        return $consulta->execute();
    }


}
?>