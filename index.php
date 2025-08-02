<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ESP32-CAM Live Stream</title>
</head>
<body>
  <h1>Live-Bild von der ESP32-CAM</h1>
  <img id="cam" src="uploads/cam.jpg?t=0" width="640">
  <script>
    setInterval(() => {
      document.getElementById('cam').src = 'uploads/cam.jpg?t=' + new Date().getTime();
    }, 500); // alle 0.5 Sekunden neu laden
  </script>
</body>
</html>
