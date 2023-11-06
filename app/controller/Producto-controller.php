<?php

include_once(__DIR__ . '/../model/Producto.php');

class controllerProducto 
{
    public static function altaProducto($area_producto, $pedido_asociado, $estado, $descripcion, $costo, $tiempo_desde)
    {
        $producto = Producto::crearProducto($area_producto, $pedido_asociado, $estado, $descripcion, $costo, $tiempo_desde);
        $res = Producto::agregarProducto($producto);
        // bool
        return $res;
        
    }

    public static function listarProductos() 
    {
        $productos = Producto::obtenerProductos();
        return $productos; 
    }
}

?>