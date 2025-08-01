<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Willkommen!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            background: white;
            padding: 2rem;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="submit"] {
            padding: 0.5rem;
            margin-top: 1rem;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hallo, willkommen auf meiner Seite!</h1>

        <form method="POST" action="">
            <label for="name">Wie heißt du?</label><br>
            <input type="text" id="name" name="name" required><br>
            <input type="submit" value="Absenden">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["name"])) {
            $name = htmlspecialchars($_POST["name"]);
            echo "<p>Schön, dich kennenzulernen, <strong>$name</strong>!</p>";
        }
        ?>
    </div>
</body>
</html>
