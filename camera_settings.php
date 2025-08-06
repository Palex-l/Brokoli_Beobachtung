<?php
$settingsFile = "camera_settings.txt";

// Wenn Datei nicht existiert → mit Defaultwerten anlegen
if (!file_exists($settingsFile)) {
    file_put_contents($settingsFile, "QVGA|63");
}

// Wenn Einstellungen übermittelt wurden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validRes = ['UXGA','SXGA','XGA','SVGA','VGA','QVGA'];
    $res = $_POST['res'];
    $qual = intval($_POST['qual']);

    if (in_array($res, $validRes) && $qual >= 0 && $qual <= 63) {
        $content = $res . "|" . $qual;
        file_put_contents($settingsFile, $content);
    }

    header("Location: index.php");
    exit;
}
?>

