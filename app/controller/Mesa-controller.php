<?php

include_once(__DIR__ . '/../model/Mesa.php');

class controllerMesa 
{
    public static function altaMesa()
    {
        if (isset($_POST['codigo_mesa']) 
        && isset($_POST['id_empleado']) 
        && isset($_POST['estado'])) 
        {
            $codigo_mesa = (string) $_POST['codigo_mesa'];
            $id_empleado = (int) $_POST['id_empleado'];
            $estado = (string) $_POST['estado'];

            $mesaAux = Mesa::crearMesa($codigo_mesa, $id_empleado, $estado);
            return Mesa::agregarMesa($mesaAux);

        }
        else
        {
            print("Los parametros son invalidos! <br>");
        }


        
    }

    public static function listarMesas() 
    {
        $pedidos = Pedido::obtenerPedidos();
        return $pedidos; 
    }
}

?>