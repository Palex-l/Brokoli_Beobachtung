<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cmd'])) {
    $valid = ['once', 'stream', 'stop', 'idle'];
    $cmd = $_POST['cmd'];

    if (in_array($cmd, $valid)) {
        $file = 'camera_command.txt';

        // Falls Datei nicht existiert → versuchen anzulegen
        if (!file_exists($file)) {
            $created = @file_put_contents($file, "idle");
            if ($created === false) {
                http_response_code(500);
                echo "❌ Fehler: Datei konnte nicht erstellt werden (Berechtigung?)";
                exit;
            }
        }

        // Versuche, den neuen Befehl zu schreiben
        $written = @file_put_contents($file, $cmd);
        if ($written === false) {
            http_response_code(500);
            echo "❌ Fehler: Datei konnte nicht beschrieben werden";
            exit;
        }

        header('Location: index.php?camera=' . $cmd);
        exit;
    }
}

http_response_code(400);
echo "Ungültiger Kamerabefehl";
?>
