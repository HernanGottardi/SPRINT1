<?php

include(__DIR__ . '../controller/Empleado-controller.php');

class validarEmpleado 
{
    public static function validar () 
    {
        try 
        {
            //$id_usuario, $id_area, $nombre, $fecha_inicio
            if (isset($_POST["id_usuario"]) && isset($_POST["id_area"]) && isset($_POST["nombre"]) && isset($_POST["fecha_inicio"])) 
            {
                $id_usuario = (string) ($_POST["id_usuario"]);
                $id_area = (string) ($_POST["id_area"]);
                $nombre = (string) ($_POST["nombre"]);
                $fecha_inicio = (string) ($_POST["fecha_inicio"]);
     
                $empleado = controllerEmpleado::altaEmpleado($id_usuario, $id_area, $nombre, $fecha_inicio); 
                return $empleado;
                
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

    public static function validarNombreApellido($txt) 
    {

        $nombre = trim($txt);
    
        // Verifica si el nombre tiene la longitud adecuada
        if (strlen($nombre) < 2 || strlen($nombre) > 50) 
        {
            print("El nombre/apellido del empleado incumple la cantidad de caracteres. </br>");
            return false;
        }
    
        // Verifica si el nombre contiene solo letras (mayúsculas y minúsculas)
        if (!preg_match("/^[a-zA-Z]+$/", $nombre)) 
        {
            print("El nombre/apellido del empelado solo permite caracteres a-z. </br>");
            return false;
        }

    
        // Asegúrate de que el nombre no esté vacío
        if (empty($nombre)) 
        {
            print("El nombre/apellido esta vacio. </br>");
            return false;
        }
    
        // Si pasa todas las validaciones, el nombre es válido
        return true;
    }

    public static function validarTipo ($txt) 
    {
        $tiposValidos = ["mozo", "bartender", "cocinero", "cervecero", "socio"];
        $txtSinEspacios = trim($txt);
        $tipo = strtolower($txtSinEspacios);

        foreach ($tiposValidos as $t) 
        {
            if ($t == $tipo) 
            {
                return true;
            }
        }
        print("El tipo de empleado no existe. </br>");
        return false;
    }

    public static function validarFecha ($fecha)
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) 
        {
            return true;
        } 
        else 
        {
            print("La fecha no cumple con el formato deseado. </br>");
            return false;
        }
    }
}


?>