<?php

declare(strict_types=1);

use App\Controller\WebSocketController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', static function () {
    return '';
});


/**
 * websocket server
 */
Router::addServer('ws', static function () {
    Router::get('/', WebSocketController::class);
});