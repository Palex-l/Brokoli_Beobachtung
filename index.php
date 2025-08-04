<?php
$log = file_exists('log.txt') ? file_get_contents('log.txt') : '';
$lines = array_reverse(explode("\n", trim($log))); // Jüngste Einträge oben
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
    .log { text-align: left; margin: 20px auto; width: 90%; max-width: 600px; background: #222; padding: 10px; border-radius: 8px; }
    .log p { margin: 2px; font-size: 14px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <h1>ESP32-CAM Bild</h1>
  <img src="uploads/cam.jpg?<?php echo time(); ?>" alt="Live Bild">
  <p>Letztes Update: <?php echo date("H:i:s"); ?></p>

  <h2>ESP32-CAM Fernsteuerung</h2>
  <form method="POST" action="camera_command.php">
    <button name="cmd" value="once">📸 Bild aufnehmen</button>
    <button name="cmd" value="stream">🔁 Stream starten</button>
    <button name="cmd" value="stop">🛑 Stream stoppen</button>
  </form>
  
  <hr>
  <h2>Pumpe steuern</h2>
  <form action="pump_trigger.php" method="POST">
    <input type="number" name="ml" placeholder="Menge in ml" required min="1">
    <button type="submit">Pumpe starten</button>
  </form>
  <?php
   if (isset($_GET['ok'])) {
      echo "<p style='color:lightgreen;'>✅ Befehl gesendet!</p>";
   }
   if (isset($_GET['error']) && $_GET['error'] === 'toobig') {
    echo "<p style='color:red; font-weight:bold;'>❌ Fehler: Eingabe zu groß (max. 200 ml erlaubt)</p>";
   }
   ?>

  <hr>
  <h2>Bewässerungsprotokoll</h2>
  <div class="log">
    <?php foreach ($lines as $line): ?>
      <p class="<?= strpos($line, '❌') !== false ? 'error' : '' ?>"><?= htmlspecialchars($line) ?></p>
    <?php endforeach; ?>
  </div>
</body>
</html>
