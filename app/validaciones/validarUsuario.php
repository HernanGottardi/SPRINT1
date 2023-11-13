<?php

require_once(__DIR__ . '/../model/Empleado.php');
require_once(__DIR__ . '/../controller/UsuarioController.php');


class validarUsuario
{
    public static function validar ($request)
    {

        $parametros = $request->getParsedBody();

        $nombre_usuario = (string) $parametros["nombre_usuario"];
        $contraseña = (string) $parametros["contraseña"];
        $esAdmin = (int) $parametros["esAdmin"];
        $tipo_empleado = (string) $parametros["tipo_empleado"];

        if (validarUsuario::validarNombre($nombre_usuario) &&  validarUsuario::validarContraseña($contraseña)
        && validarUsuario::validarEsAdmin($esAdmin) && validarUsuario::validarTipoUsuario($tipo_empleado)) 
        {
            return true;
        }  

        return false;
            
    }        
    
    public static function validarEsAdmin ($admin) 
    {

        if ($admin == 0 || $admin == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function validarNombre($nombreUsuario) 
    {

        $nombre = trim($nombreUsuario);
    
        // Verifica si el nombre tiene la longitud adecuada
        if (strlen($nombre) < 5 || strlen($nombre) > 20) 
        {
            print("El nombre de Usuario debe tener entre 5 y 20 caracteres. </br>");
            return false;
        }
    
        // Verifica si el nombre contiene solo letras (mayúsculas y minúsculas)
        if (!preg_match("/^[a-zA-Z]+$/", $nombre)) 
        {
            print("El nombre de Usuario solo permite letras (a-z). </br>");
            return false;
        }
    
        // Asegúrate de que el nombre no esté vacío
        if (empty($nombre)) 
        {
            print("El nombre de Usuario esta vacio. </br>");
            return false;
        }
    
        // Si pasa todas las validaciones, el nombre es válido
        return true;
    }

    public static function validarTipoUsuario ($puesto) 
    {

        return Empleado::puestoExiste($puesto);

    }

    public static function validarContraseña ($contra) 
    {
        // Verificar la longitud
        if (strlen($contra) == 8) 
        {
            $contrasena_sin_espacios = trim($contra);

            if (!empty($contrasena_sin_espacios)) 
            {
                return true;
            } 
            else 
            {
                print "</br> La contraseña no puede ser solo espacios en blanco. </br>";
                return false;
            }
        } 
        else 
        {
            echo "</br> La contraseña debe 8 caracteres. </br>";
            return false;
        }
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