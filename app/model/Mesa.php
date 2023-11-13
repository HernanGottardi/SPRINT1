<?php


 class Mesa 
 {
    public $id;
    public $codigo_mesa;
    public $id_usuario;
    public $estado;

    public function __construct() {}

    public static function crearMesa($codigo_mesa, $id_cliente, $estado) 
    {
        $mesa = new Mesa();
        $mesa->setCodigoMesa($codigo_mesa);
        $mesa->setIdUsuario($id_cliente);
        $mesa->setEstado($estado);

        return $mesa;
    }

    //--- Getters ---//
    public function getId(){
        return $this->id;
    }

    public function getCodigoMesa(){
        return $this->codigo_mesa;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function getEstado(){
        return $this->estado;
    }

    //--- Setters ---//

    public function setId($id){
        $this->id = $id;
    }

    public function setCodigoMesa($codigo){
        $this->codigo_mesa = $codigo;
    }

    public function setIdUsuario($id){
        $this->id_usuario = $id;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public static function obtenerMesas(){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta('SELECT * FROM mesa');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public static function agregarMesa($mesa){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta('INSERT INTO mesa (codigo_mesa, id_usuario, estado) 
        VALUES (:codigo_mesa, :id_usuario, :estado)');
        $query->bindValue(':codigo_mesa', $mesa->getCodigoMesa());
        $query->bindValue(':id_usuario', $mesa->getIdUsuario());
        $query->bindValue(':estado', $mesa->getEstado());
        

        return $query->execute();
    }
 }
?>