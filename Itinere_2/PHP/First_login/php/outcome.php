<!DOCTYPE html>
<html>
<head>
    <title>Esito</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h2>Esito</h2>
    <?php
        session_start();
        
        echo "<br><p>" . $_SESSION["message"] . "</p>";
        echo "<br><p> Username: " . $_SESSION["username"] . "</p>";
        echo "<br><p> Email: " . $_SESSION["email"] . "</p>";
    ?>
    <br><a href="../index.html"><button id="orange">Torna alla homepage</button></a>
</body>
</html>
