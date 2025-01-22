<?php

class Router {
    public function route($url) {
        $url = explode('/', rtrim($url, '/'));

        try {
            if ($url[0] === 'curso' && isset($url[1])) {
                // Rota para detalhes de um curso
                $controller = new Controllers\CourseController();
                $controller->show($url[1]);
            } elseif ($url[0] === 'cursos') {
                // Rota para listar todos os cursos
                $controller = new Controllers\CoursesController();
                $controller->index();
            } elseif ($url[0] === 'home') {
                // Página inicial
                $controller = new Controllers\HomeController();
                $controller->index();
            } else {
                // Rota não encontrada
                http_response_code(404);
                echo "Página não encontrada!";
            }
        } catch (Exception $e) {
            // Erro interno no servidor
            http_response_code(500);
            echo "Ocorreu um erro no servidor: " . $e->getMessage();
        }
    }
}
