<?php

include_once(__DIR__ . '/validaciones/validarUsuario.php');

//include_once(__DIR__ . '/controller/Producto-controller.php');
include_once(__DIR__ . '/validaciones/validarProducto.php');

include_once(__DIR__ . '/validaciones/validarUsuario.php');
include_once(__DIR__ . '/controller/UsuarioController.php');


include_once(__DIR__ . '/controller/Pedido-controller.php');
include_once(__DIR__ . '/controller/Mesa-controller.php');

include_once(__DIR__ . '/middlewares/LoggerMW.php');


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



$app->group('/users', function (RouteCollectorProxy $group) 
{
    $group->get('[/]', \UsuarioController::class . ':listarUsuarios');
    $group->post('[/]', \UsuarioController::class . ':altaUsuario');
    $group->delete('[/]', \UsuarioController::class . ':BorrarUsuario');


})->add(new LoggerMiddleware());








$app->run();

?>
