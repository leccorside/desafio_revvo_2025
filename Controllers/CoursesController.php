<?php

namespace Controllers;

use Models\Course;

class CoursesController {
    public function index() {
        $courses = Course::getAllCourses();
        require 'Views/courses.php';
    }
}
