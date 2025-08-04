<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ml'])) {
    $ml = intval($_POST['ml']);
    if ($ml >= 0) {
        file_put_contents('pump_queue.txt', $ml);
        header('Location: index.php?ok=1');
        exit;
    }
}
http_response_code(400);
echo "Fehlerhafte Eingabe";
?>
