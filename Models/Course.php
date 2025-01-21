<?php

namespace Models;

class Course {
    public static function getAllCourses() {
        $filePath = __DIR__ . '/../data/courses.json';
        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            return json_decode($data, true);
        }
        return [];
    }
}
