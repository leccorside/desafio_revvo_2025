<?php
header('Content-Type: application/json');

// Caminho do arquivo JSON
$filePath = __DIR__ . '/data/courses.json';

if (!file_exists($filePath)) {
    echo json_encode([]);
    exit;
}

$courses = json_decode(file_get_contents($filePath), true);

// Obtém o termo de busca (caso exista)
$searchTerm = $_GET['q'] ?? '';

// Se o termo de busca tiver pelo menos 3 caracteres
if (strlen($searchTerm) >= 3) {
    $filteredCourses = array_filter($courses, function ($course) use ($searchTerm) {
        return stripos($course['title'], $searchTerm) !== false; // Ignora maiúsculas/minúsculas
    });

    echo json_encode(array_values($filteredCourses)); // Retorna os cursos encontrados
} else {
    echo json_encode([]); // Retorna um array vazio se o termo for menor que 3 caracteres
}
?>
