<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

include_once __DIR__ ."../validaciones/validarUsuario.php";

class LoggerMiddleware
{   
    
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $tipo_peticion = $request->getMethod();
        $respuesta = new Response();
        
        if ($tipo_peticion === 'POST') 
        {
            $data = $request->getParsedBody();
            return $this->invocacionPOST($request, $handler, $data);      
        }
        else if ($tipo_peticion === 'GET') 
        {
            $data = $request->getQueryParams();
            return $this->invocacionGET($request, $handler, $data);
        }
        else if ($tipo_peticion === 'DELETE') 
        {
            $rawData = $request->getBody()->getContents();
            $data = json_decode($rawData, true);
            return $this->invocacionDELETE($request, $handler, $data);
        }
        else
        {
            $respuesta->getBody()->write('<h1> Tipo de peticion no aceptado. </h1>');
            return $respuesta;
        }

    }

    private function invocacionPOST(Request $request, RequestHandler $handler, $argumentos): Response
    {
        $respuesta = new Response();

        if (isset($argumentos['Accion'])) 
        {
            switch ($argumentos["Accion"]) 
            {
                case 'AltaUsuario':
                    if ($this->InfoCompletaUsuario($argumentos)) 
                    {
                        if (validarUsuario::validar($request)) 
                        {
                            return $handler->handle($request);
                        }
                    }
    
                    $respuesta->getBody()->write('<h1> Error en la solicitud POST: Datos incorrectos o incompletos </h1>');
                    return $respuesta;
                
                default:
                    $respuesta->getBody()->write('<h1> La Accion no fue encontrada. </h1>');
                    return $respuesta;
            }
        }
        else
        {
            $respuesta->getBody()->write('<h1> El tipo de Accion no fue encontrado. </h1>');
            return $respuesta;
        }

    }
    private function invocacionGET(Request $request, RequestHandler $handler, $argumentos): Response
    {
        $respuesta = new Response();

        if (isset($argumentos["Accion"])) 
        {
            switch ($argumentos["Accion"]) 
            {
                case 'ListarUsuarios':
                    
                    return $handler->handle($request);   
                
                default:
                    $respuesta->getBody()->write('<h1> El tipo de Accion no fue encontrado. </h1>');
                    return $respuesta;
            }
        }
        else
        {
            $respuesta->getBody()->write('<h1> La Accion no fue encontrada. </h1>');
            return $respuesta;
        }

    }
    // ...
    private function invocacionDELETE(Request $request, RequestHandler $handler, $argumentos): Response
    {
        $respuesta = new Response();

        if (isset($argumentos["Accion"])) 
        {
            switch ($argumentos["Accion"]) 
            {
                case 'EliminarUsuario':
                    if (isset($argumentos["id"])) 
                    {
                        return $handler->handle($request);   
                    }
                    $respuesta->getBody()->write('<h1> Error en los campos para eliminar usuario. </h1>');
                    return $respuesta;
                
                default:
                    $respuesta->getBody()->write('<h1> El tipo de Accion no fue encontrado. </h1>');
                    return $respuesta;
            }
        }
        else
        {
            $respuesta->getBody()->write('<h1> La Accion no fue encontrada. </h1>');
            return $respuesta;
        }
    }



    // private function validarEsAdmin(string $nombre_usuario, int $esAdmin): Response
    // {
    //     $respuesta = new Response();

    //     if ($esAdmin === 1) 
    //     {
    //         $respuesta->getBody()->write('<h1> Bienvenido ' . htmlspecialchars($nombre_usuario) . '!</h1>');
    //     } 
    //     else 
    //     {
    //         $respuesta->getBody()->write('<h1> No tienes acceso!</h1>');
    //     }

    //     return $respuesta;
    // }


    private function InfoCompletaUsuario($parametros)
    {
        if (isset($parametros['tipo_empleado']) && isset($parametros['esAdmin']) 
        && isset($parametros['contraseña']) && isset($parametros['contraseña'])) 
        {
            return true;
        }
        else
        {
            return false;  
        }
    }


}

?>
