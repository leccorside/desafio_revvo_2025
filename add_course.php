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

// Validações de entrada
$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? null;

if (!$title || !$description) {
    echo json_encode(['status' => 'error', 'message' => 'Título e descrição são obrigatórios.']);
    exit;
}

// ID único para o novo curso
$newId = count($courses) > 0 ? max(array_column($courses, 'id')) + 1 : 1;

// Upload da imagem, se fornecida
$imagePath = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageFileName = basename($_FILES['image']['name']);
    $targetDir = __DIR__ . '/public/images/';
    $targetFile = $targetDir . $imageFileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imagePath = 'public/images/' . $imageFileName;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar a imagem.']);
        exit;
    }
}

// Novo curso
$newCourse = [
    'id' => $newId,
    'title' => $title,
    'description' => $description,
    'image' => $imagePath ?? 'public/images/default.png', // Imagem padrão se nenhuma for enviada
];

// Adiciona o novo curso ao array
$courses[] = $newCourse;

// Salva os dados no arquivo JSON
if (file_put_contents($filePath, json_encode($courses, JSON_PRETTY_PRINT))) {
    echo json_encode(['status' => 'success']);  // Resposta formatada corretamente como JSON
} else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar os dados no arquivo JSON.']);
}
