<!DOCTYPE html>
<html>
<head>
  <title>ESP32 Cam + Pumpe</title>
  <meta http-equiv="refresh" content="10">
  <style>
    body { text-align: center; font-family: sans-serif; background: #111; color: white; }
    img { max-width: 90%; border: 5px solid white; margin-top: 20px; }
    input, button { padding: 10px; font-size: 16px; }
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
  <?php if (isset($_GET['ok'])) echo "<p>Befehl gesendet!</p>"; ?>
</body>
</html>
