<?php
$file = 'pump_queue.txt';

if (!file_exists($file)) exit;

$data = file_get_contents($file);
list($ml, $timestamp) = explode(';', $data);

if (intval($ml) > 0 && (time() - intval($timestamp)) > 15) {
    // Zu alt → gilt als fehlgeschlagen
    file_put_contents($file, "0;0");

    // Fehler loggen
    file_put_contents('log.txt', date("Y-m-d H:i:s") . " - ❌ Fehler: Keine Antwort von Pumpe (ml: $ml)\n", FILE_APPEND);
    echo "Fehler geloggt";
} else {
    echo "Pumpe hat wahrscheinlich reagiert oder kein Auftrag offen.";
}
?>
