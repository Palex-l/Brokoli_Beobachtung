<?php
$uploadDir = "uploads/";
$filename = "cam.jpg";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $tmpName = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmpName, $uploadDir . $filename);
    http_response_code(200);
    echo "Bild empfangen";
} else {
    http_response_code(400);
    echo "Ungültige Anfrage";
}
?>
