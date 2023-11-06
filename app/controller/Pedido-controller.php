<?php

include_once(__DIR__ . '/../model/Pedido.php');

class controllerPedido 
{
    public static function altaPedido()
    {
        if (isset($_POST['id_mesa']) && isset($_POST['estado']) 
        && isset($_POST['nombre_cliente']) && isset($_POST['imagen']) && isset($_POST['costo'])) 
        {
            $id_mesa = (int) $_POST['id_mesa'];
            $estado = (string) $_POST['estado'];
            $nombreCliente = (string) $_POST['nombre_cliente'];
            $imagen = (string) $_POST['imagen'];
            $costo = (float) $_POST['costo'];

            $pedidoAux = Pedido::crearPedido($id_mesa, $estado, $nombreCliente, $imagen, $costo);
            return Pedido::agregarPedido($pedidoAux);

        }
        else
        {
            print("Los parametros son invalidos! <br>");
        }

        
    }

    public static function listarPedidos() 
    {
        $pedidos = Mesa::obtenerMesas();
        return $pedidos; 
    }
}

?>