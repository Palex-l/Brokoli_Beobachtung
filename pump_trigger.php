<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ml'])) {
    $ml = intval($_POST['ml']);

    // ESP sendet Reset (ml = 0)
    if ($ml === 0) {
        file_put_contents('pump_queue.txt', '0');
        exit;
    }

    // Fehlerhafte Eingabe > 200 ml
    if ($ml > 200) {
        $time = date("Y-m-d H:i:s");
        $entry = "$time - ❌ Ungültige Eingabe: $ml ml (zu groß)\n";
        file_put_contents('log.txt', $entry, FILE_APPEND);

        header('Location: index.php?error=toobig');
        exit;
    }

    // Gültiger Pumpauftrag
    if ($ml > 0 && $ml <= 200) {
        file_put_contents('pump_queue.txt', $ml);

        // Sofort zurück zur Website
        header('Location: index.php?ok=1');
        flush();
        ignore_user_abort(true);

        // 20 Sekunden auf Verarbeitung durch ESP warten
        sleep(20);

        // Prüfen, ob Auftrag abgearbeitet wurde
        $remaining = file_exists('pump_queue.txt') ? trim(file_get_contents('pump_queue.txt')) : '';
        if ($remaining == $ml) {
            // ESP hat sich nicht gemeldet → als Fehler loggen
            file_put_contents('pump_queue.txt', '0');
            $time = date("Y-m-d H:i:s");
            $entry = "$time - ❌ Auftrag ($ml ml) nicht verarbeitet – ESP32 offline?\n";
            file_put_contents('log.txt', $entry, FILE_APPEND);
        }

        exit;
    }
}

http_response_code(400);
echo "Fehlerhafte Eingabe";
?>
