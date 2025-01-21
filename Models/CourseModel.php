<?php

namespace Models;

class CourseModel {
    private $filePath = 'data/courses.json';

    public function getAllCourses() {
        if (!file_exists($this->filePath)) {
            return [];
        }

        return json_decode(file_get_contents($this->filePath), true);
    }

    public function getCourseById($id) {
        $courses = $this->getAllCourses();

        foreach ($courses as $course) {
            if ($course['id'] == $id) {
                return $course;
            }
        }

        return null;
    }
}
