<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Caminho do arquivo JSON
$filePath = __DIR__ . '/data/courses.json';

if (!file_exists($filePath)) {
    echo json_encode(['status' => 'error', 'message' => 'Arquivo JSON não encontrado.']);
    exit;
}

$courses = json_decode(file_get_contents($filePath), true);
if (!$courses) {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao ler o arquivo JSON.']);
    exit;
}

// Verifica se o ID foi enviado
if (empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID do curso não fornecido.']);
    exit;
}

$id = $_POST['id'];

// Filtra o array removendo o curso com o ID correspondente
$filteredCourses = array_filter($courses, function ($course) use ($id) {
    return (string)$course['id'] !== (string)$id;
});

// Verifica se houve exclusão
if (count($courses) === count($filteredCourses)) {
    echo json_encode(['status' => 'error', 'message' => 'Curso não encontrado.']);
    exit;
}

// Salva os dados atualizados no arquivo JSON
file_put_contents($filePath, json_encode(array_values($filteredCourses), JSON_PRETTY_PRINT));

// Retorna sucesso com redirecionamento opcional
echo json_encode(['status' => 'success', 'redirect' => '/projetos/desafio_revvo2/home.php']);
exit;
