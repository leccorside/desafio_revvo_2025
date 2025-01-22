<?php
// Exibe erros para facilitar a depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload para carregar classes automaticamente
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Captura a URL solicitada
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Roteador
$router = new Router();
$router->route($url);
