<?php

include_once(__DIR__ . '/../DB/conexionDB.php');
include_once(__DIR__ . './models/Area.php');

 class Producto
 {

    public $id;
    public $id_area_producto;
    public $id_pedido_asociado;
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

    // Getter y Setter para $id_area_producto
    public function getIdAreaProducto() {
        return $this->id_area_producto;
    }

    public function setIdAreaProducto($id_area_producto) {
        $this->id_area_producto = $id_area_producto;
    }

    // Getter y Setter para $id_pedido_asociado
    public function getIdPedidoAsociado() {
        return $this->id_pedido_asociado;
    }

    public function setIdPedidoAsociado($id_pedido_asociado) {
        $this->id_pedido_asociado = $id_pedido_asociado;
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

    public static function crearProducto($id_area_producto, $id_pedido_asociado, $estado, $descripcion, $costo, $tiempo_desde) 
    {
        $producto = new Producto();
        // Puedes utilizar los setters para establecer los valores de los atributos
        $producto->setIdAreaProducto($id_area_producto);
        $producto->setIdPedidoAsociado($id_pedido_asociado);
        $producto->setEstado($estado);
        $producto->setDescripcion($descripcion);
        $producto->setCosto($costo);
        $producto->setTiempoDesde($tiempo_desde);

        return $producto;
    }

    public function calcularTiempoFinalizado()
    {
        $nuevaFecha = new DateTime($this->getTiempoDesde());
        $nuevaFecha = $nuevaFecha->modify('+'.$this->getDuracion().' minutes');
        $this->setTiempoTerminado($nuevaFecha->format('Y-m-d H:i:s'));
    }

    public static function agregarProducto($producto)
    {
        $objDataAccess = ConexionDB::acceso();
        $consulta = $objDataAccess->consulta("INSERT INTO `producto` (`id_area_producto`, `id_pedido_asociado`, `estado`, `descripcion`, `costo`, `tiempo_desde`) 
        VALUES (:area_producto, :pedido_asociado, :estado, :descripcion, :costo, :tiempo_desde)");
        
        $consulta->bindValue(':area_producto', $producto->getAreaProducto());
        $consulta->bindValue(':pedido_asociado', $producto->getIdPedidoAsociado());
        $consulta->bindValue(':estado', $producto->getEstado());
        $consulta->bindValue(':descripcion', $producto->getDescripcion());
        $consulta->bindValue(':costo', $producto->getCosto());
        $consulta->bindValue(':tiempo_desde', $producto->getTiempoDesde());
       
        return $consulta->execute();

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