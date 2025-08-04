<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cmd'])) {
    $valid = ['once', 'stream', 'stop'];
    $cmd = $_POST['cmd'];

    if (in_array($cmd, $valid)) {
        file_put_contents('camera_command.txt', $cmd);
        header('Location: index.php?camera=' . $cmd);
        exit;
    }
}
http_response_code(400);
echo "Ungültiger Kamerabefehl";
?>
