<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ml = floatval($_POST["ml"] ?? 0);
    $url = "http://esp32.local/dose?ml=" . $ml;

    // Aufruf an ESP32 senden (per GET)
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    echo "Befehl gesendet: " . htmlspecialchars($response);
} else {
    echo "Nur POST erlaubt";
}
?>
