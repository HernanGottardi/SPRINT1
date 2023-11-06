<?php

include_once(__DIR__ . '/controller/Empleado-controller.php');
include_once(__DIR__ . '/validaciones/validarEmpleado.php');

//include_once(__DIR__ . '/controller/Producto-controller.php');
include_once(__DIR__ . '/validaciones/validarProducto.php');

include_once(__DIR__ . '/controller/Pedido-controller.php');
include_once(__DIR__ . '/controller/Mesa-controller.php');


// Habilita la visualización de errores en PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Importa las clases necesarias del framework Slim y PSR
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

// Creación de una instancia de la aplicación Slim
$app = AppFactory::create();

// Configuración de la base de la ruta
$app->setBasePath('/app');

// Middleware de manejo de errores
$app->addErrorMiddleware(true, true, true);

// Middleware para analizar el cuerpo de las solicitudes HTTP
$app->addBodyParsingMiddleware();

// Definición de rutas
$app->get('[/]', function (Request $request, Response $response) {

    if (isset($_GET['Accion'])) 
    {
        switch ($_GET['Accion']) 
        {
            case 'ListarEmpleados':
                $result = controllerEmpleado::listarEmpleados(); 
                break;
            case 'ListarProductos':
                $result = controllerProducto::listarProductos();
                break;
            case 'ListarPedidos':
                $result = controllerPedido::listarPedidos();
                break;
            case 'ListarMesas':
                $result = controllerMesa::listarMesas();
                break;
            default:
                $result = ['message' => 'Acción no válida'];
                break;
        }
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
    else 
    {
        $result = ['message' => 'La clave "Accion" no se encontró en la solicitud GET'];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400); // Código de respuesta 400 para solicitud incorrecta
    }
});


$app->post('[/]', function (Request $request, Response $response) {
    
    // Obtener el cuerpo de la solicitud POST como un arreglo asociativo
    $data = $request->getParsedBody();

    if (isset($data['Accion'])) 
    {
        switch ($data['Accion']) 
        {
            case 'AltaEmpleado':
                $result = validarEmpleado::validar(); 
                break;
            case 'AltaProducto':
                $result = validarProducto::validar();
                break;
            case 'AltaPedido':
                $result = controllerPedido::altaPedido();
                break;
            case 'AltaMesa':
                $result = controllerMesa::altaMesa();
                break;
            default:
                $result = ['message' => 'Acción no válida'];
                break;
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    } 
    else 
    {
        $result = ['message' => 'La clave "Accion" no se encontró en la solicitud POST'];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400); // Código de respuesta 400 para solicitud incorrecta
    }
});

// Inicia la aplicación Slim
$app->run();

?>
