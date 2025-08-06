<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validRes = ['UXGA','SXGA','XGA','SVGA','VGA','QVGA'];
    $res = $_POST['res'];
    $qual = intval($_POST['qual']);

    if (in_array($res, $validRes) && $qual >= 0 && $qual <= 63) {
        $content = $res . "|" . $qual;
        file_put_contents("camera_settings.txt", $content);
    }

    header("Location: index.php");
    exit;
}
?>
