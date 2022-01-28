<?php

require_once __DIR__ . '/../../vendor/autoload.php';

define('BASE_PATH', realpath(__DIR__ . '/../../'));

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);
$dotenv->load();

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', App\Controllers\InfoController::class . '/index');
    $r->addRoute('POST', '/login', App\Controllers\InfoController::class . '/login');
    $r->addRoute('GET', '/logout', App\Controllers\InfoController::class . '/logout');
    $r->addRoute('GET', '/home', App\Controllers\InfoController::class . '/home');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
//    case FastRoute\Dispatcher::FOUND:
//        $handler = $routeInfo[1];
//        $vars = $routeInfo[2];
//        // ... call $handler with $vars
//        break;
//    case FastRoute\Dispatcher::FOUND:
//        $handler = $routeInfo[1];
//        $vars = $routeInfo[2];
//        list($class, $method) = explode('/', $handler, 2);
//        $controller = $container->build()->get($class);
//        $controller->{$method}(...array_values($vars));
//        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        echo call_user_func_array(array(new $class, $method), $vars);
        return;
}
