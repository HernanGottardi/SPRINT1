<?php

include_once(__DIR__ . '/../model/Usuario.php');
include_once(__DIR__ . '/../interfaces/IUsuarios.php');

class UsuarioController implements IUsuarios
{
    public function altaUsuario($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre_usuario = $parametros['nombre_usuario'];
        $contraseña = $parametros['contraseña'];
        $esAdmin = $parametros['esAdmin'];
        $tipo_empleado = $parametros['tipo_empleado'];

        $fecha_inicio = (string) date("Y/m/d"); 
        $estado = "Activo";

        $usuario = Usuario::crearUsuario($nombre_usuario, $contraseña, $esAdmin, $tipo_empleado, $estado, $fecha_inicio);
        Usuario::agregarUsuario($usuario);

        $arrayRespuesta = json_encode(array("mensaje" => $usuario));
        $response->getBody()->write($arrayRespuesta);

        return $response->withHeader('Content-Type', 'application/json');
    }


    public function listarUsuarios($request, $response, $args) 
    {
        $usuarios = Usuario::obtenerUsuarios();
        
        $arrayRes = json_encode(array("mensaje" => $usuarios));

        $response->getBody()->write($arrayRes);

        return $response->withHeader('Content-Type', 'application/json');
    }


    public function BorrarUsuario($request, $response, $args)
    {
        $rawData = $request->getBody()->getContents();
        $params = json_decode($rawData, true);
        try 
        {
            $usuarioAEliminar = Usuario::obtenerUsuarioPorID($params['id']);
            Usuario::eliminarUsuario($usuarioAEliminar);
    
            $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));
            $response->getBody()->write($payload);
            
        } 
        catch (Exception $th) 
        {
            $payload = json_encode(array("mensaje" => $th->getMessage()));
            $response->getBody()->write($payload);
        }
        finally
        {
            return $response->withHeader('Content-Type', 'application/json');
        }

    }

    
	public function ModificarUsuario($request, $response, $args){}
}

?>