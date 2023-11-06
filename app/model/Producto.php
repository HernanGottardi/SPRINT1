<?php

include_once(__DIR__ . '/../DB/conexionDB.php');
include_once(__DIR__ . './models/Area.php');

 class Producto{

    public $id;
    public $area_producto;
    public $pedido_asociado;
    public $estado;
    public $descripcion;
    public $costo;
    public $tiempo_desde;
    public $tiempo_terminado;
    public $duracion;

    public function __construct() {}

    // Getter y Setter para $id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter y Setter para $area_producto
    public function getAreaProducto() {
        return $this->area_producto;
    }

    public function setAreaProducto($area_producto) {
        $this->area_producto = $area_producto;
    }

    // Getter y Setter para $pedido_asociado
    public function getPedidoAsociado() {
        return $this->pedido_asociado;
    }

    public function setPedidoAsociado($pedido_asociado) {
        $this->pedido_asociado = $pedido_asociado;
    }

    // Getter y Setter para $estado
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Getter y Setter para $descripcion
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Getter y Setter para $costo
    public function getCosto() {
        return $this->costo;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    // Getter y Setter para $tiempo_desde
    public function getTiempoDesde() {
        return $this->tiempo_desde;
    }

    public function setTiempoDesde($tiempo_desde) {
        $this->tiempo_desde = $tiempo_desde;
    }

    // Getter y Setter para $tiempo_terminado
    public function getTiempoTerminado() {
        return $this->tiempo_terminado;
    }

    public function setTiempoTerminado($tiempo_terminado) {
        $this->tiempo_terminado = $tiempo_terminado;
    }

    // Getter y Setter para $duracion
    public function getDuracion() {
        return $this->duracion;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public static function crearProducto($area_producto, $pedido_asociado, $estado, $descripcion, $costo, $tiempo_desde) {
        $dish = new Producto();
        // Puedes utilizar los setters para establecer los valores de los atributos
        $dish->setAreaProducto($area_producto);
        $dish->setPedidoAsociado($pedido_asociado);
        $dish->setEstado($estado);
        $dish->setDescripcion($descripcion);
        $dish->setCosto($costo);
        $dish->setTiempoDesde($tiempo_desde);

        return $dish;
    }

    public function calcularTiempoFinalizado(){
        $newDate = new DateTime($this->getTiempoDesde());
        $newDate = $newDate->modify('+'.$this->getDuracion().' minutes');
        $this->setTiempoTerminado($newDate->format('Y-m-d H:i:s'));
    }

    public static function agregarProducto($producto){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta("INSERT INTO `producto` (`area_producto`, `pedido_asociado`, `estado`, `descripcion`, `costo`, `tiempo_desde`) 
        VALUES (:area_producto, :pedido_asociado, :estado, :descripcion, :costo, :tiempo_desde)");
        
        $query->bindValue(':area_producto', $producto->getAreaProducto());
        $query->bindValue(':pedido_asociado', $producto->getPedidoAsociado());
        $query->bindValue(':estado', $producto->getEstado());
        $query->bindValue(':descripcion', $producto->getDescripcion());
        $query->bindValue(':costo', $producto->getCosto());
        $query->bindValue(':tiempo_desde', $producto->getTiempoDesde());
       
        return $query->execute();

    }

    public static function obtenerProductos()
    {
        $objDataAccess = ConexionDB::acceso();
        $consulta = $objDataAccess->consulta("SELECT * FROM `producto`");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


}
     
?>