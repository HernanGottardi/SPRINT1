<?php

include_once(__DIR__ . '/../model/Empleado.php');

class controllerEmpleado 
{
    public static function altaEmpleado($id_usuario, $id_area, $nombre, $fecha_inicio)
    {
        $empleado = Empleado::crearEmpleado($id_usuario, $id_area, $nombre, $fecha_inicio);
        return $empleado->agregarEmpleado();
    }

    public static function listarEmpleados() 
    {
        $empleados = Empleado::obtenerEmpleados();
        return $empleados; 
    }
}

?>