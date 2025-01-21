<?php

namespace Controllers;

use Models\Course; // Importa o modelo Course

class HomeController {
    public function index() {
        // Obter todos os cursos do modelo
        $allCourses = Course::getAllCourses();

        // Obter os 3 últimos cursos cadastrados
        $latestCourses = array_slice($allCourses, -3);

        // Passar as variáveis necessárias para a view
        $courses = $allCourses; // Todos os cursos

        // Incluir a view
        require __DIR__ . '/../Views/home.php';
    }
}
