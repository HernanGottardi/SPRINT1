<?php


include_once(__DIR__ . '/../DB/conexionDB.php');


class Pedido
{

    public $id;
    public $id_mesa;
    public $estado;
    public $nombre_cliente;
    public $imagen;
    public $costo;

    public function __construct(){}

    public static function crearPedido($id_mesa, $estado, $nombre_cliente, $imagen, $costo = 0) {
        $newOrder = new Pedido();
        $newOrder->setIdMesa($id_mesa);
        $newOrder->setEstado($estado);
        $newOrder->setNombreCliente($nombre_cliente);
        $newOrder->setImagen($imagen);
        $newOrder->setCosto($costo);

        return $newOrder;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdMesa() {
        return $this->id_mesa;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNombreCliente() {
        return $this->nombre_cliente;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getCosto() {
        return $this->costo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdMesa($id_mesa) {
        $this->id_mesa = $id_mesa;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setNombreCliente($nombre_cliente) {
        $this->nombre_cliente = $nombre_cliente;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public static function agregarPedido($pedido){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta('INSERT INTO pedido (id_mesa, nombre_cliente, imagen, costo, estado) 
        VALUES (:id_mesa, :nombre_cliente, :imagen, :costo, :estado)');
        $query->bindValue(':id_mesa', $pedido->getIdMesa());
        $query->bindValue(':nombre_cliente', $pedido->getNombreCliente());
        $query->bindValue(':imagen', $pedido->getImagen());
        $query->bindValue(':costo', $pedido->getCosto());
        $query->bindValue(':estado', $pedido->getEstado());
        
        return $query->execute();
    }

    public static function obtenerPedidos(){
        $objDataAccess = ConexionDB::acceso();
        $consulta = $objDataAccess->consulta('SELECT * FROM pedido');
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>