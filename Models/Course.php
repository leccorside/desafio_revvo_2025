<?php

class Course {
    public static function getAllCourses() {
        $data = file_get_contents('data/courses.json');
        $courses = json_decode($data, true);
        return is_array($courses) ? $courses : [];
    }
}
