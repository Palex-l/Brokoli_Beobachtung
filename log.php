<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ml'])) {
        $ml = intval($_POST['ml']);
        $time = date("Y-m-d H:i:s");
        $entry = "$time - $ml ml\n";
        file_put_contents($logFile, $entry, FILE_APPEND);
        echo "OK";
        exit;
    }

    if (isset($_GET['error'])) {
        $time = date("Y-m-d H:i:s");
        $entry = "$time - ❌ Fehler bei der Bewässerung\n";
        file_put_contents($logFile, $entry, FILE_APPEND);
        echo "Fehler geloggt";
        exit;
    }
}
http_response_code(400);
echo "Ungültige Anfrage";
?>
