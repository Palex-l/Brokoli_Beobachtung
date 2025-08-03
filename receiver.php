<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$data = file_get_contents('php://input');
if ($data) {
    $filePath = $uploadDir . 'cam.jpg';
    file_put_contents($filePath, $data);
    http_response_code(200);
    echo "Upload successful";
} else {
    http_response_code(400);
    echo "No data received";
}
?>
