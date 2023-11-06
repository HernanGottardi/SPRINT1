<?php

include_once(__DIR__ . '/../DB/conexionDB.php');
include_once(__DIR__ . './model/Empleado.php');

class Usuario{
    
    //--- Attributes ---//
    public $id;
    public $nombre_usuario;
    public $contraseña;
    public $esAdmin;
    public $tipo_usuario;
    public $estado;
    public $fecha_inicio;
    public $fecha_final;

    //--- Default Constructor ---//
    public function __construct(){}

    public static function crearUsuario($nombreUsuario, $contraseña, $esAdmin, $tipoUsuario, $estado, $fechaInicio){
        $user = new Usuario();
        $user->setNombreUsuario($nombreUsuario);
        $user->setContraseña($contraseña);
        $user->setEsAdmin($esAdmin);
        $user->setTipoUsuario($tipoUsuario);
        $user->setEstado($estado);
        $user->setFechaInicio($fechaInicio);
        return $user;
    }

    // Getter para $id
    public function getId() {
        return $this->id;
    }

    // Setter para $id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter para $nombre_usuario
    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    // Setter para $nombre_usuario
    public function setNombreUsuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    // Repite el proceso para los demás atributos...

    // Getter y Setter para $contraseña, $esAdmin, $tipo_usuario, $estado, $fecha_inicio y $fecha_final
    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function getEsAdmin() {
        return $this->esAdmin;
    }

    public function setEsAdmin($esAdmin) {
        $this->esAdmin = $esAdmin;
    }

    public function getTipoUsuario() {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getFechaInicio() {
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFinal() {
        return $this->fecha_final;
    }

    public function setFechaFinal($fecha_final) {
        $this->fecha_final = $fecha_final;
    }
    
    /**
     * Converts the string 'True' or 'False' to a boolean like 1 for true and 0 for false.
     *
     * @param string $bool The string to be converted to a boolean value in numeric format.
     * @return int The converted boolean value in numeric format.
     */
    private function validateBool($bool){
        return strtolower($bool) == "true";
    }

    public static function insertUser($user){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->prepareQuery("INSERT INTO usuario (nombre_usuario, contraseña, esAdmin, tipo_usuario, estado, fecha_inicio) 
        VALUES (:nombreUsuario, :contra, :esAdmin, :tipoUsuario, :estado, :fechaInicio)");
        $passwordHash = password_hash($user->getContraseña(), PASSWORD_DEFAULT);
        $query->bindValue(':nombreUsuario', $user->getNombreUsuario(), PDO::PARAM_STR);
        $query->bindValue(':contra', $passwordHash);
        $query->bindValue(':esAdmin', $user->getEsAdmin(), PDO::PARAM_INT);
        $query->bindValue(':tipoUsuario', $user->getTipoUsuario(), PDO::PARAM_STR);
        $query->bindValue(':estado', $user->getEstado(), PDO::PARAM_STR);
        $query->bindValue(':fechaInicio', $user->getFechaInicio(), PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Gets all the rows from the Usuario table.
     * @return PDOStatement All the rows.
     */
    public static function getAllUsers(){

        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->prepareQuery("SELECT * FROM usuario");
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    public static function getUser($employee){

        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->prepareQuery("SELECT * FROM usuario AS u
        JOIN empleado AS e
        ON :id = u.id");
        $query->bindValue(':id', $employee->getUserId(), PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject('Usuario');
    }

    public static function getUserById($id){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->prepareQuery("SELECT * FROM usuario WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetchObject('Usuario');
        if(is_null($user)){
            throw new Exception("User not found");
        }
        return $user;
    }

    public static function getUserByUsername($username){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->prepareQuery("SELECT * FROM usuario WHERE username = :username");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetchObject('Usuario');
        if(is_null($user)){
            throw new Exception("User not found");
        }
        return $user;
    }


}
?>