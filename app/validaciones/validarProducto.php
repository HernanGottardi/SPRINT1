<?php

include(__DIR__ . '/../controller/Producto-controller.php');


class validarProducto 
{
    public static function validar () 
    {
        try 
        {

            if (isset($_POST["area_producto"]) && isset($_POST["pedido_asociado"]) 
            && isset($_POST["estado"]) && isset($_POST["descripcion"])
            && isset($_POST["costo"]) && isset($_POST["tiempo_desde"]))
            {
                $id_area = (int) ($_POST["area_producto"]);
                $id_pedido_asociado = (int) ($_POST["pedido_asociado"]);
                $estado = (string) ($_POST["estado"]);
                $descripcion = (string) ($_POST["descripcion"]);
                $costo = (float) ($_POST["costo"]);
                $tiempo_desde = (string) ($_POST["tiempo_desde"]);
                

                // validaciones:
                $producto = controllerProducto::altaProducto($id_area, $id_pedido_asociado, $estado, $descripcion, $costo, $tiempo_desde);
                return $producto;
                
            }
            else
            {
                print("Error en los parametros recibidos. </br>");
            }
        }
        catch (Exception $e)
        {
            print("ERROR: " . $e);
        }
    }

    public static function validarNombre ($nombreProducto) 
    {
        $productosValidos = ["cerveza", "vino","milanesa", "hamburguesa", "papas"];
        $producto = trim($nombreProducto);

        foreach ($productosValidos as $p) 
        {
            if ($p == $producto) 
            {
                return true;
            }
        }
        return false;
    }

    public static function combinacionTipoConNombre ($nombreProducto, $nombreTipo) 
    {
        $productosComida = ["milanesa", "hamburguesa", "papas"];
        $productosBebida =  ["cerveza", "vino"];
        
        $producto = trim($nombreProducto);

        // itero comidas.
        if ($nombreTipo == "comida") 
        {
            foreach ($productosComida as $p) 
            {  
                if ($p == $producto) 
                {
                    return true;
                }
            }
            print("El tipo del producto es 'comida' pero ningun plato con ese nombre fue encontrado.");
            return false;
        }
        // itero bebidas.
        else if ($nombreTipo == "bebida")
        {
            foreach ($productosBebida as $p) 
            {
                if ($p == $producto) 
                {
                    return true;
                }
            }
            print("El tipo del producto es 'bebida' pero ningun trago con ese nombre fue encontrado.");
            return false;
        }
        
    }

    public static function validarTipoProducto ($tipoProducto) 
    {
        $productosValidos = ["comida", "bebida"];

        foreach ($productosValidos as $t) 
        {
            if ($t == $tipoProducto) 
            {
                return true;
            }
        }
        return false;
    }
}


?>