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

if (empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID do curso não fornecido.']);
    exit;
}

$id = $_POST['id'];
$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? null;

$updated = false;
foreach ($courses as &$course) {
    if ((string)$course['id'] === (string)$id) {
        $course['title'] = $title ?? $course['title'];
        $course['description'] = $description ?? $course['description'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageFileName = basename($_FILES['image']['name']);
            $targetDir = __DIR__ . '/public/images/';
            $targetFile = $targetDir . $imageFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $course['image'] = 'public/images/' . $imageFileName;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar a nova imagem.']);
                exit;
            }
        }

        $updated = true;
        break;
    }
}

if ($updated) {
    file_put_contents($filePath, json_encode($courses, JSON_PRETTY_PRINT));
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Curso não encontrado.']);
}
