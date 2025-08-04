<!DOCTYPE html>
<html>
<head>
  <title>Live-Cam</title>
  <meta http-equiv="refresh" content="10">
  <style>
    body { text-align: center; font-family: sans-serif; background: #111; color: white; }
    img { max-width: 90%; border: 5px solid white; margin-top: 20px; }
  </style>
</head>
<body>
  <h1>Aktuelles Bild der ESP32-CAM</h1>
  <img src="uploads/cam.jpg?<?php echo time(); ?>" alt="Live Bild">
  <p>Letztes Update: <?php echo date("H:i:s"); ?></p>
</body>
  <form method="POST" action="dose.php">
  <label for="ml">Milliliter:</label>
  <input type="number" name="ml" min="1" max="1000" required>
  <button type="submit">Pumpe starten</button>
</form>
</html>
