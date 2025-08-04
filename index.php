<?php
$error = file_exists("last_error.txt") ? file_get_contents("last_error.txt") : null;
$log = file_exists("watering_log.txt") ? file("watering_log.txt") : [];
?>

<!DOCTYPE html>
<html>
<head>
  <title>ESP32 Cam + Pumpe</title>
  <meta http-equiv="refresh" content="10">
  <style>
    body { text-align: center; font-family: sans-serif; background: #111; color: white; }
    img { max-width: 90%; border: 5px solid white; margin-top: 20px; }
    input, button { padding: 10px; font-size: 16px; }
    .error { color: red; font-weight: bold; }
    .log { margin-top: 20px; background: #222; padding: 10px; border-radius: 8px; display: inline-block; text-align: left; }
  </style>
</head>
<body>
  <h1>ESP32-CAM Bild</h1>
  <img src="uploads/cam.jpg?<?php echo time(); ?>" alt="Live Bild">
  <p>Letztes Update: <?php echo date("H:i:s"); ?></p>

  <hr>
  <h2>Pumpe steuern</h2>
  <form action="pump_trigger.php" method="POST">
    <input type="number" name="ml" placeholder="Menge in ml" required min="1">
    <button type="submit">Pumpe starten</button>
  </form>

  <?php if ($error): ?>
    <p class="error">❌ Letzte Bewässerung fehlgeschlagen:<br><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <div class="log">
    <h3>Log vergangener Bewässerungen:</h3>
    <pre><?php foreach (array_reverse($log) as $line) echo htmlspecialchars($line); ?></pre>
  </div>
</body>
</html>
