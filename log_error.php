<?php
file_put_contents("last_error.txt", "Fehlgeschlagen am " . date("d.m.Y H:i:s"));
http_response_code(200);
?>
