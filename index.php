<?php

// Autoload para carregar classes automaticamente
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Captura a URL solicitada e a divide em partes
$url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : ['home'];

// Roteamento simples
try {
    if ($url[0] === 'curso' && isset($url[1])) {
        // Exibir detalhes de um curso específico
        $controller = new Controllers\CourseController();
        $controller->show($url[1]);
    } elseif ($url[0] === 'home') {
        // Página inicial
        $controller = new Controllers\HomeController();
        $controller->index();
    } else {
        // Página de erro 404
        http_response_code(404);
        echo "Página não encontrada!";
    }
} catch (Exception $e) {
    // Tratamento de erros gerais
    http_response_code(500);
    echo "Ocorreu um erro no servidor: " . $e->getMessage();
}
