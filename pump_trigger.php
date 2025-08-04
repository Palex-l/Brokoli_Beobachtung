<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ml'])) {
    $ml = intval($_POST['ml']);

    // 1. Trigger zurücksetzen
    if ($ml === 0) {
        file_put_contents('pump_queue.txt', '0');
        exit;
    }

    // 2. Neuer Pumpbefehl: eintragen
    if ($ml > 200) {
      // In Log schreiben
      $time = date("Y-m-d H:i:s");
      $entry = "$time - ❌ Ungültige Eingabe: $ml ml (zu groß)\n";
      file_put_contents('log.txt', $entry, FILE_APPEND);
 
      // Fehlermeldung zurück zur Website
      //header('Location: index.php?error=toobig');
      echo "Eingabe zu groß"; // für ESP sichtbar
      exit;
    }
    if ($ml > 0 && $ml <= 200) {
        file_put_contents('pump_queue.txt', $ml);

        // Start Timeout-Überwachung (asynchron über PHP sleep)
        // Funktioniert nur, wenn dein Render-Container >20s Scriptausführung erlaubt
        ignore_user_abort(true);
        flush(); // sende Antwort sofort
        //echo "Befehl angenommen"; // für ESP sichtbar
        //exit;
        
        // 3. Warte 20 Sekunden auf Verarbeitung durch ESP
        sleep(60);
        
        // 4. Prüfen ob Auftrag noch da (→ ESP hat nicht abgeholt)
        $remaining = file_exists('pump_queue.txt') ? trim(file_get_contents('pump_queue.txt')) : '';
        if ($remaining == $ml) {
            // → Auftrag wurde nicht verarbeitet → abbrechen und Fehler loggen
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
