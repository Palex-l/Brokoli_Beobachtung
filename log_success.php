<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ml'])) {
    $ml = intval($_POST['ml']);
    if ($ml > 0 && $ml <= 1000) {
        $timestamp = date("[d.m.Y H:i:s]");
        $entry = "$timestamp Erfolgreiche Bewässerung: {$ml} ml\n";
        file_put_contents("watering_log.txt", $entry, FILE_APPEND);
        http_response_code(200);
        exit;
    }
}
http_response_code(400);
echo "Ungültiger Logeintrag";
?>
