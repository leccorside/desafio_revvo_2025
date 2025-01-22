<?php

namespace Controllers;

use Models\Course;

class CourseController {
    public function show($id) {
        // Obter todos os cursos
        $allCourses = Course::getAllCourses();

        // Filtrar o curso pelo ID
        $course = array_filter($allCourses, function ($c) use ($id) {
            return $c['id'] == $id;
        });

        // Obter o primeiro curso encontrado
        $course = reset($course);

        // Verificar se o curso existe
        if (!$course) {
            http_response_code(404);
            echo "Curso não encontrado!";
            return;
        }

        // Renderizar a página de detalhes do curso
        require __DIR__ . '/../Views/single.php';
    }
}
