<?php

require_once 'Models/Course.php';

class HomeController {
    public function index() {
        // Obter todos os cursos
        $allCourses = Course::getAllCourses();

        // Obter os 3 últimos cursos cadastrados
        $latestCourses = array_slice($allCourses, -3);

        // Passar as variáveis necessárias para a view
        $courses = $allCourses; // Todos os cursos
        require 'Views/home.php';
    }
}
