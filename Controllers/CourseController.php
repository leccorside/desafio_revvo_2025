<?php

namespace Controllers;

use Models\CourseModel;

class CourseController {
    public function show($id) {
        $model = new CourseModel();
        $course = $model->getCourseById($id);

        if (!$course) {
            die("Curso não encontrado.");
        }

        include 'Views/single.php';
    }
}
