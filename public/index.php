<?php

require_once '../core/Router.php';
require_once '../config/config.php';

use Core\Router;

// Inicializa o roteador
$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
